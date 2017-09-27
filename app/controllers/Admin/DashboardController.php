<?php
namespace Admin;
use View;

class DashboardController extends BaseController {

	public $params = [
        'module' => 'Панель управления',
        'route' => 'dashboard'
    ];

    function index()
    {
        return View::make(
            $this->viewName(__FUNCTION__),
            [
                'params' => $this->params
            ]
        );
    }
}