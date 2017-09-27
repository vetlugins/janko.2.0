<?php
define('EMAIL_ADMIN_SENT_TO', 'html@aisconverse.com');
define('EMAIL_ADMIN_SUBJECT', 'Feedback letter from contacts form on CBGram');
define('EMAIL_CLIENT_SUBJECT', 'Feedback letter from CBGram');

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: html@aisconverse.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

$errors = array();
$name    = strip_tags(trim(!empty($_POST['name'])  ? $_POST['name']  : ''));
$email   = strip_tags(trim(!empty($_POST['email']) ? $_POST['email'] : ''));
$message = nl2br(strip_tags(trim(!empty($_POST['message']) ? $_POST['message'] : '')));

if (empty($name)) {
    $errors[] = 'name';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'email';
}

if (empty($message)) {
    $errors[] = 'message';
}

$response = array('status' => 'ok');

$datetime = date('Y-m-d H:i:s');

$letterToAdmin = <<<MSG
<html>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

    <strong>Feedback form</strong><br/>
    Author: {$name} <a href="mailto:{$email}">{$email}</a><br/>
    Message: <br/>
    {$message} <br/><br/>
    Email was sent at {$datetime}
</body>
</html>
MSG;

$letterToClient = <<<MSG
<html>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

    Hi, {$name}! <br/>
    You was sent message to administrators CBGram at {$datetime}.<br/><br/>
    Wait answer in few days. We will send our reply on {$email} <br/>

    Your message: <br/>

    {$message} <br/><br/>

    Thank you for your letter!
</body>
</html>
MSG;


if (empty($errors)) {
    mail(EMAIL_ADMIN_SENT_TO, EMAIL_ADMIN_SUBJECT, $letterToAdmin, $headers);
    mail($email, EMAIL_CLIENT_SUBJECT, $letterToClient, $headers);
} else {
    $response = array('status' => 'error', 'errors' => $errors);
}

die(json_encode($response));