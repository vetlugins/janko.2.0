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
use Cover;

class WidgetsController extends BaseController {

    public $params = [
        'module' => 'Лэндинг на главной странице',
        'route' => 'widgets',
        'model' => 'Widget',
    ];

	public function visibility ()
    {
		$model = $this->params['model'];

        $id = Input::get ( 'id' );

		$item = $model::find ( $id );

		$item->visible = !$item->visible;

		$item->save ();

		return Response::json ([ $item->visible ] );
	}

    public function structure()
    {
        $model = $this->params['model'];
        $items = \Input::get('array_order');

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
            ->sEnabled()
            ->orderBy('position', 'asc')
            ->get()
        ;

        return View::make(
            $this->viewName(__FUNCTION__),
            [
                'items' => $items,
                'params' => $this->params
            ]
        );
    }


    public function edit($id)
    {
        $item  = $this->getItem($id);

        $view = $item->view($id);

        return View::make(
            $this->viewName($view),
            [
                'item' => $item,
                'params' => $this->params,
            ]
        );

    }

    public function update($id)
    {
        $item  = $this->getItem($id);

        $this->fillItem ( $item );

		if ($item->save())
        {
            return Redirect::route( 'admin.'.$this->params['route'].'.edit', [$id])
                ->with('success', trans('admin_messages.update_success'));
        }				
       
	   return Redirect::route( 'admin.'.$this->params['route'].'.edit', [$id])
            ->withInput()
            ->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail'))
            ->withErrors($item->errors);
		
    }

    private function fillItem( $item )
    {
		$input = Input::only('visible');

        $item->fill( $input );

        $item->jd('widget',Input::get('jdata.widget'));

        $item->visible = intval ( Input::get('visible') );

        $blocks = Input::file('jdata.widget.fields.blocks');
        foreach($blocks as $i => $blockData) {
            $file = array_get($blockData, 'slide');
            if ($file) {
                $filename = $file->getClientOriginalName();
                $filename = $this->trans_filename($filename);
                aprint($filename);die;
                $item->jd("widget.fields.blocks.{$i}.slide", $filename);
                $file->move(public_path('system').'/Widget/slider/', $filename);
            }
        }

        aprint(json_encode($item->jdata));
        aprint($blocks);die;


    }

    public function getItem($id)
    {
        $model = $this->params['model'];
        return $model::findOrFail($id);
    }

    public function saveAttachments($item)
    {
        $item->saveCover( $this->getCoverParams() );
    }

    protected function getCoverParams() {
        return Input::only('cover')['cover'] ?: [];
    }


}