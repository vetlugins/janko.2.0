<?php
namespace Admin;
use Cover;
use Photo;
use Input;
use Redirect;
use Rubric;
use View;
use Response;
use App;
use Cache;
use Files;
use JavaScript;
ini_set('MAX_FILE_UPLOAD', '100');
ini_set('post_max_size', '500M');
ini_set('client_max_body_size', '500M');


class FilesController extends BaseController {

	public $params = [
		'route' => 'files',
		'model' => 'Files',
		'module' => 'Файлы',
	];

	public function store($object_type,$object_id){

		$save_success = 0;

		$files = Input::only('files')['files'] ?: [];

		if($files){
			$object_item = $object_type::find ( $object_id );
			$object_item->saveFiles();
			$save_success = 1;
		}


		if ( $save_success ) {
			$this->clearCache ( $object_type, $object_id );
			return Redirect::route('admin.'.$this->params['route'].'.index', array('object_type' => $object_type, 'object_id' => $object_id ) )
				->with('success', trans('admin_messages.'.$this->params['route'].'.save_success') );
		}
		else
			return Redirect::route('admin.'.$this->params['route'].'.index', array('object_type' => $object_type, 'object_id' => $object_id ) )
				->with('error', trans('admin_messages.'.$this->params['route'].'.save_fail_no_files'));
		

	}
	
	public function index ( $object_type, $object_id )
	{
		if ( class_exists ( $object_type ) )
		{
			$object_item = $object_type::find ( $object_id );

			if ( $object_item )
			{
				$this->params['object_type'] = $object_type;
				$this->params['object_id'] = $object_id;					
				$this->params['object_route'] = $object_item->route;
				$this->params['object_name'] = $object_item->title;

				if ( !empty($object_item->parent_id) )
				{
					$object_item_parent = $object_type::find ( $object_item->parent_id );

					if ( $object_item_parent )
					{
						$this->params['object_parent_name'] = $object_item_parent->title;					
						$this->params['object_parent_id'] = $object_item_parent->id;					
					}
				}

				return View::make(
					$this->viewName(__FUNCTION__),
					[
						'object_item' => $object_item,
						'params' => $this->params,
						'items' => $object_item
					]
				);
			}
			else App::abort ( 404 );
		}
		else {
			App::abort ( 404 );
		}
		
	}
	
	public function destroy( $id ) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);
		$this->clearCacheById ( $id );
		$file = $item->get_path().'/'.$item->filename;
		$item->delete_files ( $file );
		$item->delete();			
		return Redirect::route('admin.'.$this->params['route'].'.index', array ( 'object_type' => $item->objectable_type, 'object_id' => $item->objectable_id ) )
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success') );
	}


	protected function treeData ( $item ) {
		$result = [];
		$result['id']    = $item->id;
		$result['label'] = $item->title;
		$result['ext'] = $item->ext;
		$result['row'] = View::make ( 'admin.'.$this->params['route'].'.index_row', compact ( 'item' ) + ['params' => $this->params] )->__toString();
		return $result;
	}

	public function clearCache ( $object_id, $object_type )  {
		
	}

	public function clearCacheById ( $id ) {
		
	}
}