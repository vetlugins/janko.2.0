<?php

namespace Admin;
use Cover;
use Controller;
use Event;
use View;
use Config;
use Page;
use Rubric;
use CatRubric;
use Adv;
use AdvRubric;
use Album;
use Article;
use News;
use PeopleNews;
use PeopleRubric;
use Objects;
use URL;
use Tag;
use Param;
use Cache;
use Banner;
use Language;

class BaseController extends Controller {

    public $params = [];

    public $viewNames = [
        'index' => 'index.index',
        'edit' => 'edit.edit',
        'create' => 'edit.edit',
        'show' => 'show.show',
    ];

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            Event::fire('clockwork.controller.start');
        });

        $this->afterFilter(function()
        {
            Event::fire('clockwork.controller.end');
        });

        View::share('modContent',Config::get('modules/content'));
        View::share('modManage' ,Config::get('modules/manage'));
        View::share('modCatalog',Config::get('modules/catalog'));
    }

    /**
      * Setup the layout used by the controller.
      *
      * @return void
      */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
          $this->layout = View::make($this->layout);
        }
    }

    /**
     * Создание вьюх
     */
    public function viewName($method)
    {
        return 'admin.' . $this->getRoute() . '.' . array_get($this->viewNames, $method, "{$method}.{$method}");
    }
    public function getRoute()
    {
        return $this->getParam('route');
    }
    public function getParam($param)
    {
        return array_get($this->params, $param);
    }
}