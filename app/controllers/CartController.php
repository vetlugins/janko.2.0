<?php

class CartController extends BaseController {

	public function index () {
		$page = Page::url('cart')->firstOrFail();
		$basket = Session::get ( 'basket' ) ?: [] ;
		$ids = [''];
		foreach ( $basket as $item ) {
			$ids[] = $item['id'];
		}
		$items = Objects::with('cover')->whereIn ( 'id',  $ids )->get();
		foreach ( $items as $obj ) {
			$obj->count = 0;			
			foreach ( $basket as $item )
				if ( $item['id'] == $obj->id ) {
					$obj->count = $item['count'];
					break;
				}
		}

		$slides = Slider::visible()->get();

		return View::make('frontend.products.cart', compact( 'page', 'items', 'slides' ));
	}

	public static function retrieveCartItems() {
		$basket = Session::get ( 'basket' ) ?: [] ;
		$ids = [];
		foreach ( $basket as $item ) {
			$ids[] = $item['id'];
		}
		return $ids;
	}

	public function addToCart () {
		$id = Input::get ( 'id' );
		$count = Input::get ( 'count' );
		$basket = Session::get ( 'basket' );
		if ( $id ) {			
			if ( !$this->inBasket ( $id, $basket ) ) {
				$cost = Objects::find ( $id )->cost;
				$discount = Objects::find ( $id )->discount;
				$basket[] = ['id' => $id, 'count' => $count, 'cost' => $cost, 'discount' => $discount];
				Session::put ( 'basket', $basket );
			}			
		}
		return array ( 'total_count' => CartController::getTotalCount(), 'total_cost' => output_numbers ( CartController::getTotalCost () ) );
	}
	
	public function updateCount () {
		$id = Input::get ( 'id' );
		$count = Input::get ( 'count' );
		$basket = Session::get ( 'basket' );
		$item_count = 0;
		if ( $id ) {			
			foreach ( $basket as $k => $item ) {
				if ( $item['id'] == $id ) {
					$basket[$k]['count'] = $item['count'] + $count;				
					$item_count = $basket[$k]['count'];
					$item_cost = $item_count * $item['cost'];
					
					break;
				}
			}	
			Session::put ( 'basket', $basket );			
		}
		return array ( 'item_count' => $item_count, 'total_count' => CartController::getTotalCount(), 'total_cost' => CartController::getTotalCost (), 'item_cost' => $item_cost );
	}
	
	public function deleteFromCart () {
		$id = Input::get ( 'id' );
		if ( $id ) {
			$basket = Session::get ( 'basket' );
			foreach ( $basket as $k => $item ) {
				if ( $item['id'] == $id )
					unset ( $basket[$k] );
			}
			Session::put ( 'basket', $basket );
		}
		return array ( 'total_count' => CartController::getTotalCount(), 'total_cost' => CartController::getTotalCost () );
	}
	
	static public function inBasket ( $id ) {
		$basket = Session::get ( 'basket' ) ? : [];
		foreach ( $basket as $item ) {
			if ( $item['id'] == $id )
				return true;
		}
	
		return false;
	}
	
	static public function getTotalCost () {		
		$basket = Session::get ( 'basket' ) ? : [];
		$cost = 0;
		foreach ( $basket as $item ) {
			$cost += $item['cost'] * $item['count'];
		}
		return $cost;
	}
	
	static public function getTotalCount () {		
		$basket = Session::get ( 'basket' ) ? : [];
		$count = 0;
		foreach ( $basket as $item ) {
			$count += $item['count'];
		}
		return $count;
	}
	
}