<?php
include_once '/../../Classes/include_dao.php';
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
	$picture = new Picture();
  } else {
	$picture = DAOFactory::getPictureDAO()->load($id);
  }
  return ($picture) ;
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

  $picture = new Picture();
  $picture->name = $php_object->name;
  $picture->id = $php_object->id;
  $picture->artistid = $php_object->artistid;
  $picture->dimensions = $php_object->dimensions;
  $picture->keywords = $php_object->keywords;
  $picture->longDescr = $php_object->longDescr;
  $picture->shortDescr = $php_object->shortDescr;
  $picture->path = $php_object->path;
  $picture->thPath = $php_object->thPath;
  $picture->price = $php_object->price;
  $picture->status = $php_object->status;

  if ($picture->id == 0) {
	$picture->id = DAOFactory::getPictureDAO()->insert($picture);
  } else {
	DAOFactory::getPictureDAO()->update($picture);
  }

  return ($picture);
}

function delete($id)
{
  if ($id>0) {
	$picture = DAOFactory::getPictureDAO()->delete($id);
	return $picture;
  }
}
function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}

?>