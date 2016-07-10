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
		$picture = DAOFactory::getArtistDAO()->load($id);
		
	}
	$picture->longDescr = htmlspecialchars_decode($picture->longDescr);
	return ($picture) ;
}

function post($data) {

	//Sanitize the json received from the client-side
	//Keys correspond to 'data:{ js_string: val , js_array: arr,  js_object: obj }' in $.ajax
	if(isset($data['js_string'])) $string = ($data['js_string']);
	if(isset($data['js_array']))  $json_array = ($_POST['js_array']);
	if(isset($data['js_object'])) $json_object = ($_POST['js_object']);

	//Decode the json to get workable PHP variables
	//$php_array = json_decode($json_array);
	$php_object = json_decode($json_object);
	
	$artist = new Artist();
	$artist->firstname = $php_object->firstname;
	$artist->lastname = $php_object->lastname;
	$artist->shortDescr = $php_object->shortDescr;
	$artist->longDescr = htmlspecialchars($php_object->longDescr);
	$artist->profilePicturePath = $php_object->profilePicturePath;
	$artist->id = $php_object->id;
	$artist->createdDate = date('Y-m-d H:i:s');
	$artist->deletedDate = $php_object->deletedDate;
	
	if ($artist->id == 0) {
		$artist->id = DAOFactory::getArtistDAO()->insert($artist);
	} else {
		DAOFactory::getArtistDAO()->update($artist);
	}
	
	return $artist;
}

function delete($id)
{
	if ($id>0) {
		$artist = DAOFactory::getArtistDAO()->delete($id);
		return $artist;
	}
}
function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}

?>