<?php
namespace Admin;
use \Auth;
use \Input;
use \Redirect;
use \View;

class SessionsController extends BaseController
{
    protected $layout = 'admin.layout_no_header';
    public $params = [
        'route' => 'sessions'
    ];

    function create()
    {
        return View::make(
            $this->viewName('index'),
            ['params' => $this->params]
        );
    }

    function store()
    {
        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')]))
        {
            return Redirect::intended('admin');
        } else {
            return Redirect::to('/admin/login')
                    ->withError('Неверный email адрес или пароль')
                    ->withInput(Input::except('password'));
        }
    }

    function destroy()
    {
        Auth::logout();
        return Redirect::to('/admin/login')
                ->withSuccess('Вы вышли из системы.');
    }

}