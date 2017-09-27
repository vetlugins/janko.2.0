<?php

include_once app_path() . '/support/phpmailer.class.php';

class MailController extends BaseController {

	public function send() {
		$input = Input::all();

		$params = [
			'template' 	=> 'emails.letter',
			'to' 		=> Contacts::obtain('email_callback'),
			'subject' 	=> $input['subject'] ? $input['subject'] : 'Без темы',
		];

		$fields = [
			'name' 		=> $input['name'],
			'phone' 	=> $input['phone'] ? $input['phone'] : '',
			'date' 		=> date('Y-m-d H:i:s'),
			'text'		=> $input['msg'],
			'email' 	=> $input['email'],
			'subject' 	=> $input['subject'] ? $input['subject'] : 'Без темы',
			'file' 		=> $input['file'] ? $input['file'] : ''
		];

		$this->sendEmail($params,$fields);

		return $input;
	}

	public function callme() {
		$input = Input::all();

		$params = [
			'template' => 'emails.callback',
			'to' => Contacts::obtain('email_callback'),
			'subject' => 'Заявка на обратный звонок с сайта ГК "ВАРТЭ"',
		];

		$fields = [
			'phone' => $input['phone']
		];

		$this->sendEmail($params,$fields);

		return $input;
	}

	static public function getRecipients() {
		$email = Contacts::select('value')->where('id_val', 'email')->first();
		$recipients = array(
			0 => array('email' => $email->value )
		);	
		return $recipients;	
	}

	protected function sendEmail(array $params, array $fields){

		$mail = new PHPMailer();
		$mail->From = 'gk.varte@yandex.ru';
		$mail->FromName = 'ГК "ВАРТЭ"';
		$mail->Subject = $params['subject'];
		$mail->IsHTML(true);
		$mail->Charset = "UTF-8";
		$mail->Body = View::make($params['template'])->with('fields',$fields)->render();
		$mail->AddAddress($params['to']);

		if(!empty($fields['file'])) {
			$mail->AddAttachment($fields['file']->getPathname(), $fields['file']->getClientOriginalName());
		}

		$error = !$mail->Send();

		return $error;
	}
}
