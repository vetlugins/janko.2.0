<?php

class OrderController extends BaseController {

	public function create() {
		$data = Input::All();

		$file = !empty($data['person_file']) ? $data['person_file'] : '';

		if($file) {

			$filename = $file->getClientOriginalName();

			$dot = mb_strrpos($filename, '.', 0, 'UTF-8');
			$name = mb_substr($filename, 0, $dot, 'UTF-8');
			$ext = mb_substr($filename, $dot + 1, mb_strlen($filename, 'UTF-8') - $dot-1, 'UTF-8');

			$filename = translit($name) . '_' . time() . '.' . $ext;

			$file->move(public_path().'/system/Email', $filename);

			$files = [
				'name' => 	$filename,
				'tmp' => public_path().'/system/Email/'.$filename
			];

			$data['person_file'] = $filename;
		}else{
			$files = [];
			$data['person_file'] = '';
		}

		$data['total_cost'] = CartController::getTotalCost();
		$data['date'] = date ( 'Y-m-d H:i' );
		$order = Order::Create($data);

		$basket = Session::get ( 'basket' ) ?: [] ;
		$ids = [];
		$costs = [];
		$amounts = [];
		foreach ( $basket as $item ) {
			$ids[ $item['id'] ] = [ 'amount' => $item['count'], 'cost' => $item['cost'], 'discount' => intval($item['discount']) ];			
		}

		$order->objects()->sync($ids);
		Session::forget('basket');

		$data['products_list'] = $order->objects;
		$data['id'] = $order->id;

		$email_order = Contacts::obtain('email_order') ? Contacts::obtain('email_order') : '';

		if($email_order){
			$params = [
				'template' => 'emails.order_success',
				'to' => $email_order,
				'subject' => 'Оформлен новый заказ в интернет-магазине ГК "Варте"',
			];

			$this->sendEmail($params,$data,$files);
		}

		if($data['person_email']){

			$params = [
				'template' => 'emails.order_success',
				'to' => $data['person_email'],
				'subject' => 'Оформлен новый заказ в интернет-магазине ГК "Варте"',
			];

			$this->sendEmail($params,$data,$files);

		}

		$page = Page::url('catalog')->firstOrFail();
		$slides = Slider::visible()->get();

		return View::make('frontend/products/checkout',compact('data','slides','page'));
	}

	protected function sendEmail(array $params, array $fields, $files){

		include_once app_path() . '/support/phpmailer.class.php';

		$mail = new PHPMailer();
		$mail->From = 'gkvarte@yandex.ru';
		$mail->FromName = 'ГК "ВАРТЭ"';
		$mail->Subject = $params['subject'];
		$mail->IsHTML(true);
		$mail->Charset = "UTF-8";
		$mail->Body = View::make($params['template'],['fields' => $fields])->render();
		$mail->AddAddress($params['to']);

		if(!empty($files)) {
			$mail->AddAttachment($files['tmp'], $files['name']);
		}

		$error = !$mail->Send();

		return $error;
	}

}
