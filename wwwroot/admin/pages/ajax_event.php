<?php
include_once '/../../Classes/include_dao.php';
include_once "/../../utilities/common.php";

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
    break;
    $result = post($_POST);
}


echo json_encode($result);


/************************************************************************************/
function get($id) {
  if ($id==0) {
	$event = new Blog();
  } else {
	$event = DAOFactory::getBlogDAO()->load($id);
  }
  
  return ($event) ;
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

  $event = new Blog();
  $event->title = $php_object->title;
  $event->id = $php_object->id;
  $event->message= $php_object->message;
  
  $event->startDate = $php_object->startDate;
  $event->endDate = $php_object->endDate;
  
  if ($event->id == 0) {
	$event->id = DAOFactory::getBlogDAO()->insert($event);
  } else {
	DAOFactory::getBlogDAO()->update($event);
  }
  return ($picture);
}

function delete($id)
{
  if ($id>0) {
	$event = DAOFactory::getBlogDAO()->delete($id);
	return $event;
  }
}
function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}

?>