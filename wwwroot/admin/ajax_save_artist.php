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

$artist = new Artist();
$artist->name = $php_object->name;
$artist->shortDescr = $php_object->shortdescr;
$artist->longDescr = $php_object->longdescr;
//$artist->profilePicturePath = $php_object->profilepicturepath;
$artist->id = $php_object->id;
$artist->createdDate = date('y-m-d');
$artist->deletedDate = $php_object->deleteddate;

if ($artist->id == 0) {
	$artist->id = DAOFactory::getArtistDAO()->insert($artist);
} else {
	DAOFactory::getArtistDAO()->update($artist);
}

echo json_encode($artist);
?>