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

$php_object = json_decode($json_object);

$artist = new Artist();
$artist->id = $php_object->id;
$artist->deletedDate = date('Y-m-d H:i:s');

if ($artist->id == 0) {
} else {
	DAOFactory::getArtistDAO()->remove($artist);
}

echo json_encode($artist);
?>