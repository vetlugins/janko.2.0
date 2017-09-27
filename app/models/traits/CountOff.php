<?php
/**
 * Count-off - managing positions within scope
 *
 * Trait to enrich your models with the ability to act as list.
 *
 * Inspired by {@link https://github.com/swanandp/acts_as_list Rails acts_as_list gem}.
 *
 * In your class do something like
 * <pre>
 * class Employee extends Eloquent {
 *
 *	use \Soundrussian\CountOff\CountOff;
 *
 *
 *	protected $position_col = 'position';
 *	protected $scoped_by    = 'department';
 *
 * };
 * </pre>
 *
 * After this you can treat Employees like positioned items within respective departments. (Well, in reality you should just treat
 * them with respect, we'll be treating employees like items only for the sake of making an example). For example:
 *
 * <pre>
 * 	$employee->moveHigher();
 *  $employee->moveLower();
 *  $employee->insertAt(5);
 *  $employee->moveToTop();
 *  $employee->isFirst();
 * </pre>
 * 
 * By the way, in this library "higher" means "with the lower position", and "lower" means "with the higher position". If you don't want
 * to get confused, imagine a vertical list starting with 0.
 *
 * <strong>Beware!</strong> All non-query methods (not starting with is) will save the model. 
 *
 * @author Pavel Nosov
 * @license http://opensource.org/licenses/MIT MIT
 */
trait CountOff {

	public function addNewToTop () {
		$position = $this->_position_col();
		$this->_scoped()->where($position, '>', $this->{$position} )->increment($position);
		$this->{$position} = 0;
		$this->save();
	}
	
	public function addNewToBottom () {
		$position = $this->_position_col();		
		$this->{$position} = $this->_lowestPosition()+1;
		$this->save();
	}

	/**
	 * Moves the instanse to the top of the list.
	 * 
	 * @return null
	 */
	public function moveToTop() {
		$position = $this->_position_col();
		$this->_incrementHigherItemsPosition();
		$this->{$position} = 0;
		$this->save();
	}

	/**
	 * Moves the instance to the bottom of the list.
	 * 
	 * @return null
	 */
	public function moveToBottom() {
		$position = $this->_position_col();
		$this->_decrementLowerItemsPosition();
		$this->{$position} = $this->_lowestPosition();
		$this->save();
	}

	/**
	 * Moves the instance one position lower, swapping places with the next element.
	 * 
	 * @return null
	 */
	public function moveLower() {
		$position = $this->_position_col();
		$next 	  = $this->nextItem();
		$next->{$position} = $this->{$position};
		$this->{$position} = $this->{$position} + 1;
		$next->save();
		$this->save();
	}

	/**
	 * Moves the instance one position higher, swapping places with the previous element.
	 * 
	 * @return null
	 */
	public function moveHigher() {
		$position = $this->_position_col();
		$prev 	  = $this->prevItem();
		$prev->{$position} = $this->{$position};
		$this->{$position} = $this->{$position} - 1;
		$prev->save();
		$this->save();
	}

	/**
	 * Move the item to the given position (zero-based).
	 * 
	 * @param mixed $pos
	 * @return null
	 */
	public function insertAt($pos) {
		$position = $this->_position_col();
		$old_pos  = $this->{$position};
		if ($pos == $old_pos) return;
		if ($pos > $old_pos) {
			$this->_decrementPositionsWithin($old_pos, $pos);
		} else {
			$this->_incrementPositionsWithin($pos, $old_pos);
		}
		$this->{$position} = $pos;
		$this->save();
	}

	/**
	 * Returns the next item in the list or null, if this item is the last one.
	 * 
	 * @return mixed
	 */
	public function nextItem() {
		if ($this->isLast()) return null;
		$position = $this->_position_col();
		return $this->_scoped()
					->where($position, '>', $this->{$position})
					->orderBy($position)->limit(1)
					->get()->first();
	}


	/**
	 * Returns the previous item in the list or null, if this item is the first one.
	 * 
	 * @return mixed
	 */
	public function prevItem() {
		if ($this->isFirst()) return null;
		$position = $this->_position_col();
		return $this->_scoped()
					->where($position, '<', $this->{$position})
					->orderBy($position, 'desc')->limit(1)
					->get()->first();
	}

	/**
	 * Tells if this item is the first in the list.
	 * 
	 * @return bool
	 */
	public function isFirst() {
		$position = $this->_position_col();
		return $this->{$position} == 0;
	}

	/**
	 * Tells if this item is the last in the list.
	 * 
	 * @return bool
	 */
	public function isLast() {
		$position = $this->_position_col();
		return $this->{$position} == $this->_scoped()->max($position);
	}


	private function _incrementHigherItemsPosition() {
		$position = $this->_position_col();
		$this->_scoped()->where($position, '<', $this->{$position})->increment($position);
	}

	private function _decrementLowerItemsPosition() {
		$position = $this->_position_col();				
		$this->_scoped()->where($position, '>', $this->{$position} )->decrement($position);
	}

	private function _incrementPositionsWithin($from, $to) {
		$position = $this->_position_col();
		$this->_scoped()->where($position, '>=', $from)
						->where($position, '<', $to)
						->increment($position);
	}

	private function _decrementPositionsWithin($from, $to) {
		$position = $this->_position_col();
		$this->_scoped()->where($position, '>', $from)
						->where($position, '<=', $to)
						->decrement($position);
	}

	private function _lowestPosition() {
		return $this->_scoped()->count() - 1;
	}

	private function _scoped() {
		$scope_col = $this->scoped_by;
		if ( is_array ( $scope_col ) ) {
			$query = $this;
			foreach ( $scope_col as $i => $col ) {
				$scope_val = $this->{$col};
				if ( !$i )
					$query = self::where($col,'=',$scope_val);
				else
					$query->where($col,'=',$scope_val);
			}
			return $query;
		}
		elseif ($scope_col) {
			$scope_val = $this->{$scope_col};
			return self::where($scope_col, '=', $scope_val);
		} else {
			return $this;
		}
	}

	private function _position_col() {
		if(isset($this->position_col)) return $this->position_col;
		return 'position';
	}

}