<?php
function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}

include_once '../Classes/include_dao.php';

$method = $_POST;

//Sanitize the json received from the client-side
//Keys correspond to 'data:{ js_string: val , js_array: arr,  js_object: obj }' in $.ajax
if(isset($method['js_string'])) $string = sanitize($method['js_string']);
if(isset($method['js_array']))  $json_array = sanitize($method['js_array']);
if(isset($method['js_object'])) $json_object = sanitize($method['js_object']);


//Decode the json to get workable PHP variables
//$php_array = json_decode($json_array);
$php_object = json_decode($json_object);

$exhibition = new Exhibition();
$exhibition->name = $php_object->name;
//$artist->profilePicturePath = $php_object->profilepicturepath;
$exhibition->id = $php_object->id;
$exhibition->startDate = $php_object->startDate;
$exhibition->endDate = $php_object->endDate;

if ($exhibition->id == 0) {
	$artist->id = DAOFactory::getExhibitionDAO()->insert($exhibition);
} else {
	DAOFactory::getExhibitionDAO()->update($exhibition);
}

echo json_encode($exhibition);
?>