<?php

namespace Admin;
use \User;
use \View;


class UsersActivityController extends BaseController
{
	public function index($user_id)
	{
		$items = User::with('activities')->findOrFail($user_id);
		return View::make('admin.users.activity.index', compact('items'));
	}
}