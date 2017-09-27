<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use RemindableTrait;
	use Ability;
	use Roles;

	protected $table = 'users';
	protected $password_confirmation = '';
	protected $hidden = array('password');
	protected $guarded = array('id');

	public function activities()
	{
		return $this->hasMany('Activity')->orderBy('created_at', 'desc');
	}

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public function displayName()
	{
		if ($this->name) return $this->name;
		return $this->email;
	}

}
