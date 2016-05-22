<?php
function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}

include_once '/../../Classes/include_dao.php';

$method = $_POST;

//Sanitize the json received from the client-side
//Keys correspond to 'data:{ js_string: val , js_array: arr,  js_object: obj }' in $.ajax
if(isset($method['js_string'])) $string = sanitize($method['js_string']);
if(isset($method['js_array']))  $json_array = sanitize($method['js_array']);
if(isset($method['js_object'])) $json_object = sanitize($method['js_object']);


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
$picture->price = $php_object->price;
$picture->status = $php_object->status;


if ($picture->id == 0) {
	$picture->id = DAOFactory::getPictureDAO()->insert($picture);
} else {
	DAOFactory::getPictureDAO()->update($picture);
}

echo json_encode($picture);
?>