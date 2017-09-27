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

ini_set('MAX_FILE_UPLOAD', '100');
ini_set('post_max_size', '500M');
ini_set('client_max_body_size', '500M');


class PhotosController extends BaseController {

	public $params = [
		'module' => 'Фотографии',
		'route' => 'photos',
		'model' => 'Photo'
	];
	
	public function store ( $object_type, $object_id )
	{
		$photo = Input::only('file') ?: [];


		$object_item = $object_type::find ( $object_id );

		$save_success = 0;

		if(is_object ( $photo['file'])){

			$new_photo = new Photo;
			$new_photo->setParams ( $new_photo->cover_styles );
			$new_photo->fill( ['image' => $photo['file']])->trans_filename();
			$new_photo->visible = 1;
			$new_photo->title = isset ( $object_item->title ) ? $object_item->title : '';
			$object_item->photos()->save ( $new_photo );
			//$new_photo->image->destroy ( ['original'] );
			$save_success = 1;
		}

		if ( $save_success )
		{
			$this->clearCache ( $object_type, $object_id );
			return Redirect::route('admin.'.$this->params['route'].'.index', array('object_type' => $object_type, 'object_id' => $object_id ) )
					->with('success', '');
		}
		else
			return Redirect::route('admin.'.$this->params['route'].'.index', array('object_type' => $object_type, 'object_id' => $object_id ) )
					->with('error', trans('admin_messages.'.$this->params['route'].'.save_fail_no_photos'));					
		
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
						'photos' => $object_item->aphotos
					]
				);
			}
			else App::abort ( 404 );
		}
		else {
			App::abort ( 404 );
		}
		
	}

	public function create ( $object_type, $object_id )
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
						'photos' => $object_item->aphotos
					]
				);
			}
			else App::abort ( 404 );
		}
		else {
			App::abort ( 404 );
		}

	}
	
	public function visibility ()
	{
		$model = $this->params['model'];

		$id = Input::get ( 'id' );

		$item = $model::findOrFail ( $id );

		$item->visible = !$item->visible;

		$item->save ();

		$this->clearCacheById ( $id );

		return Response::json ([ $item->visible ] );
	}

	public function rotation () {
		$model = $this->params['model'];
		$id = Input::get ( 'id' );
		$item = $model::findOrFail ( $id );
		$item->rotation = !$item->rotation;
		$item->save ();
		$this->clearCacheById ( $id );
		return Response::json ( array ( 1 ) );
	}

	public function destroy( $id )
	{
		$model = $this->params['model'];

		$item = $model::findOrFail($id);

		$this->clearCacheById ( $id );

		$item->delete_files ( $item->cover_styles );

		$item->delete();

		return Redirect::route('admin.'.$this->params['route'].'.index', [
				'object_type' => $item->object_type,
				'object_id' => $item->object_id
			])
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success') );
	}
	
	public function edit_title ()
	{
		$model = $this->params['model'];

		$id = Input::get ( 'id' );

		$title = Input::get ( 'title' );

		$item = $model::find ( $id );

		$item->title = $title;

		$item->save ();

		return ['title' => $title ];
	}

	public function clearCache ( $object_id, $object_type )  {
		
	}

	public function clearCacheById ( $id ) {
		
	}
}