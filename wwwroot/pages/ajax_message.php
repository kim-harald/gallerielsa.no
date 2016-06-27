<?php

include_once '../Classes/include_dao.php';
if (!isset($_GET["verb"])) {
	die("No verb set!");
}

$method = $_GET["verb"];

$id = isset($_GET["id"])?$_GET["id"]:0;

switch (strtoupper($method)) {
	case "GET" :
		$result = get($id);
		break;
	case "DELETE" :
		$result = delete($id);
		break;
	case "POST" :
		$result = post($_POST);
		break;
	case "PUT" :
		$result = post($_POST);
		break;
	case "SEND" :
		$result = send($_POST);
}

echo json_encode($result);

/************************************************************************************/
function get($id) {
	
}

function post($data) {

	//Sanitize the json received from the client-side
	//Keys correspond to 'data:{ js_string: val , js_array: arr,  js_object: obj }' in $.ajax
	if(isset($data['js_string'])) $string = sanitize($data['js_string']);
	if(isset($data['js_array']))  $json_array = sanitize($_POST['js_array']);
	if(isset($data['js_object'])) $json_object = sanitize($_POST['js_object']);

	//Decode the json to get workable PHP variables
	//$php_array = json_decode($json_array);
	$php_object = json_decode($json_object);
	$m = new Message();
	$m->id = isset($php_object->id)?$php_object->id:0;
	$m->createdDate = (new DateTime())->format("Y-m-d H:i:s");
	$m->name = $php_object->name;
	$m->email = $php_object->email;
	$m->subject = $php_object->subject;
	$m->message = $php_object->message;
	if ($m->id==0) {
		DAOFactory::getMessageDAO()->insert($m);
	} else {
		DAOFactory::getMessageDAO()->update($m);
	}
	
	return $m;
}

function delete($id)
{
	if ($id>0) {
	}
}
function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}

function send($data) {
	$m = post($data);
	mail_gun_smtp($m);
	return $m;
}

function mail_utf8($to, $from_user, $from_email,
		$subject = '(No subject)', $message = '')
{
	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

	$headers = "From: $from_user <$from_email>\r\n".
			"MIME-Version: 1.0" . "\r\n" .
			"Content-type: text/html; charset=UTF-8" . "\r\n";

     return mail($to, $subject, $message, $headers);
}

function mail_gun_smtp($m) {
	// Using Awesome https://github.com/PHPMailer/PHPMailer

	require '../PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'postmaster@sandbox41b1f744b2b14b81a9f55432e56f1990.mailgun.org';   				// SMTP username
	$mail->Password = '84bce9ad974433d7eeea6fd320e63c2a';                        // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

	$mail->From = 'noreply@kimharald.com';
	$mail->FromName = $m->name;
	$mail->addAddress($m->email);                 // Add a recipient

	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

	$mail->Subject = $m->subject;
	$mail->Body    = $m->message;

	if(!$mail->send()) {
		$m->status = "Failed";
		
	} else {
		$m->status = "Ok";
	}
	
	return $m;
}

?>