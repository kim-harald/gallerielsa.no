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
	if (mail_utf8($m->email,$m->subject,$m->message)) {
		$m->status = "Ok";
	} else {
		$m->status = "Failed";
	}
	DAOFactory::getMessageDAO()->update($m);
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


?>