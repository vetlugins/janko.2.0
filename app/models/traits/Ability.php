<?php

trait Ability
{
	public function can($verb, $noun)
	{
		$class = is_string($noun) ?: get_class($noun);
		switch($class) {
			case 'User':
				return $this->canManageUsers($verb, $noun);
				break;
			default:
				return $this->fallback($verb, $noun);
		}
	}

	public function canManageUsers($verb, $noun)
	{
		switch($verb) {
			case 'edit':
				if ($this->hasRole('admin')) return true;
				if ($noun->id == $this->id)  return true;
				break;
			case 'delete':
				if ($noun->id == $this->id) return false;
				break;
		}
		return $this->fallback($verb, $noun);		
	}

	public function fallback($verb, $noun)
	{
		if ($this->hasRole('admin')) return true;
		return false;
	}

}