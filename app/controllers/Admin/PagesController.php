<?php
namespace Admin;
use Ancestry;
use JavaScript;
use Input;
use Menu;
use Page;
use Redirect;
use Response;
use Validator;
use View;
use Cache;
use URL;
use Language;
use Config;

class PagesController extends BaseController {

    public $params = [
        'module' => 'Страницы сайта',
        'route' => 'pages',
        'model' => 'Page',
    ];

	public function visibility ()
    {
		$item = $this->getItem(Input::get('id'));

		$item->visible = !$item->visible;

		$item->save();

		return Response::json([$item->visible]);
	}

    public function structure()
    {
        $model = $this->params['model'];
        $items = Input::get('array_order');

        $count = 1;

        foreach ($items as $id_val)
        {
            $model::where('id','=',$id_val)
                ->update(['position' => $count])
            ;

            $count ++;
        }

    }

    public function index()
    {
        $model = $this->params['model'];

        $items = $model::query()
            ->sFirstLevel()
            ->sSorted()
            ->with(['subPages' => function($subPages) {
                $subPages->sSorted();
            }])
            ->get()
        ;

        return View::make(
            $this->viewName(__FUNCTION__),
            [
                'params' => $this->getParams(__FUNCTION__),
                'items' => $items
            ]
        );
    }

    public function create()
    {
        $item = new $this->params['model'];

        return View::make(
            $this->viewName(__FUNCTION__),
            [
                'params' => $this->getParams(__FUNCTION__),
                'item' => $item,
                'edit_type' => __FUNCTION__,
            ]
        );
    }

    public function store()
    {
        $item = new $this->params['model'];

        $this->fillItem($item);

        if ($item->save()) {
            $this->saveAttachments($item);
            return Redirect::route( 'admin.'.$this->params['route'].'.edit', $item->id)
                ->with('success', trans('admin_messages.'.$this->params['route'].'.save_success', ['title' => $item->title]));
        }
        return Redirect::route( 'admin.'.$this->params['route'].'.create')
            ->withInput()
            ->with('error', trans('admin_messages.'.$this->params['route'].'.save_fail'))
            ->withErrors($item->errors);
    }

    public function edit($id)
    {
        $item = $this->getItem($id);
        return View::make($this->viewName(__FUNCTION__),
            compact(
                'item'
            ) + array(
                'params' => $this->getParams(__FUNCTION__, $item),
                'edit_type' => __FUNCTION__
            )
        );
    }

    public function update($id)
    {
        $page = $this->getItem($id);

        $this->fillItem ( $page );

        //aprint(Input::all()); die;

        if ($page->save())
        {
            $this->saveAttachments($page);

            return Redirect::route( 'admin.'.$this->params['route'].'.edit', [$id])
                ->with('success', trans('admin_messages.'.$this->params['route'].'.update_success'));
        }

        return Redirect::route( 'admin.'.$this->params['route'].'.edit', [$id])
            ->withInput()
            ->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail'))
            ->withErrors($page->errors);

    }

    public function destroy($id)
    {
        $item = $this->getItem($id);

        $item->delete();

        $this->deleteAttachments($item);

        return Redirect::route('admin.'.$this->params['route'].'.index')
            ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success', ['title' => $item->title]));
    }


    public function fillItem($item)
    {
        $item->fill(Input::all());

        $item->visible = intval ( Input::get('visible') );

    }

    public function saveAttachments($item)
    {
        $item->saveCover( $this->getCoverParams() );
        $this->saveMenuTypes($item);
    }

    public function deleteAttachments($item)
    {
        if ( is_object ( $item->cover  ) )
        {
            $item->cover->delete_files ( $item->cover_styles );
            $item->cover->delete ();
        }
    }

    public function getItem($id) {
        $model = $this->params['model'];
        return $model::findOrFail($id);
    }

    public function getParams($method = null, $item = null)
    {
        $params = $this->params;

        if (in_array($method, ['create', 'edit']))
        {
            // parent pages
            $pages = Page::query()->sFirstLevel();

            if ($method == 'edit' && $item) {
                $pages->where('id', '!=', $item->id);
            }

            $pages = $pages->lists('title', 'id');

            $params['parentPages'] =
                [0 => 'Верхний уровень']
                +
                $pages
            ;

            // menu types
            $menu_items = Menu::all();

            $params['menus'] = [];

            foreach ( $menu_items as $menu_item ) {
                $params['menus'][$menu_item->id] = [
                    'name' => $menu_item->name,
                    'checked' => ($method == 'edit') ? in_array($menu_item->id, $item->menu->lists('id')):0
                ];
            }
        }

        return $params;
    }

    protected function getCoverParams() {
        return Input::only('cover')['cover'] ?: [];
    }

    protected function saveMenuTypes($page)
    {
        $menus = Input::get('menu_item');

        $page->menu()->detach ();

        if ( is_array ( $menus ) )
        {
            foreach ( $menus as $key => $value ) $page->menu()->attach($value);
        }
    }
}