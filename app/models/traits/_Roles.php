<?php

trait Roles
{
	public function roles()
	{
		return $this->belongsToMany('Role');
	}

    public function hasRole($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }

    public function addRole($roleName)
    {
    	$role = Role::where('name', '=', $roleName)->firstOrFail();
    	$this->roles()->attach($role);
    }
}