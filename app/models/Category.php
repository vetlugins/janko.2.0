<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Category extends BaseModel {

	use SoftDeletingTrait;

	protected 	$table = 'categories';
	protected 	$guarded = ['id'];

	/**
	 * Relations
	*/
	public function parents(){
		return $this->hasMany('Category','parent_id');
	}

	/**
	 * Validation
	 */
	protected function beforeValidation()
	{
		if (!$this->self_url) $this->self_url = $this->translit($this->title);

		if ( $this->parent_id ) $this->url = self::where('id',$this->parent_id)->pluck('url').'/'.$this->self_url;
		else $this->url = $this->self_url;
	}

    protected function validationRules()
	{
        $rules['title'] = "required|max:255";

		if ($this->exists) {
	        $rules['self_url'] = "required|unique_url:{$this->getTable()},$this->id|max:255|regex:/^([a-z0-9\-])+$/";
	    } else {
	        $rules['self_url'] = "required|unique_url:{$this->getTable()}|max:255|regex:/^([a-z0-9\-])+$/";
	    }

        return $rules;
    }

	/**
	 * List Category for option
	 */
	public function getPageOption($pages_option = [], $current = 0, $page_id = '')
	{
		$list = '';

		$item = [];

		if(count($pages_option)){
			$dash = ' - ';
		}else{
			$dash = '';
			$pages_option = self::where('parent_id',0)->get();
		}

		foreach($pages_option as $page)
		{

			if($page_id != $page->id)
			{
				$children = self::where('parent_id',$page->id)->get();

				/*if(count($children) > 0){
					$item['get_children'] = $this->getPageOption($children,$current);
				}*/

				$item['id'] = $page->id;
				$item['title'] = $page->title;
				$item['dash'] = $dash;
				$item['parents'] = $children;
				$item['current'] = $current;

				$list .= View::make('admin.pages.edit._list_option',['item' => $item])->render();

				$dash .= $dash;
			}

		}
		return $list;
	}
}
