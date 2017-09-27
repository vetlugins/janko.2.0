<?php

class ModelObserver
{
	public function created($model)
	{
        return $this->saveActivity($model, 'created');
    }

	
	public function updating($model)
	{
        $original = $model->getOriginal();
        foreach($original as $index => $value){
			//не учитываем изменения определенных полей
            if($this->checkDirty($index)) {
                //проверяем, какие были ли изменены поля таблицы - если изменено хотя бы одно, то записываем это в лог
				if($value != $model[$index]){
                    return $this->saveActivity($model, 'updated');
                }
            }
        }
    }

	public function deleted($model)
	{
        return $this->saveActivity($model, 'deleted');
    }

    public function restored($model)
    {
        return $this->saveActivity($model, 'restored');
    }

    private function checkDirty($value)
    {
        $ignored = ['updated_at', 'created_at', 'deleted_at'];
        return !in_array($value, $ignored);
    }

    private function saveActivity($model, $type)
    {
    	if (Auth::user())
    	{
    	    $activity = new Activity;
    	    $activity->type = $type;
    	    $activity->observable()->associate($model);			
    	    $activity->user()->associate(Auth::user());			
			$activity->observable_name = isset ( $model->name ) ? $model->name : ( isset ( $model->title ) ? $model->title : '' );
			$activity->user_name = Auth::user()->name;
    	    $activity->forceSave();
    	}
    	return true;
    }
}