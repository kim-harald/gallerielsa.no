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

function get($id) {
	if ($id==0) {
		$exhibition = new Exhibition();
	} else {
		$exhibition = DAOFactory::getExhibitionDAO()->load($id);
	}
	return ($exhibition) ;
}

function delete($id) {
	{
		if ($id>0) {
			$exhibition = DAOFactory::getExhibitionDAO()->delete($id);
			DAOFactory::getExhibitionPictureDAO()->deleteByExhibition($id);
			return $exhibition;
		}
	}
}

function post($data) {
	if(isset($data['js_string'])) $string = sanitize($data['js_string']);
	if(isset($data['js_array']))  $json_array = sanitize($data['js_array']);
	if(isset($data['js_object'])) $json_object = sanitize($data['js_object']);
	
	
	//Decode the json to get workable PHP variables
	//$php_array = json_decode($json_array);
	$php_object = json_decode($json_object);
	
	$exhibition = new Exhibition();
	$exhibition->name = $php_object->name;
	$exhibition->longDescr = $php_object->longDescr;
	$exhibition->id = $php_object->id;
	$exhibition->startDate = $php_object->startDate;
	$exhibition->endDate = $php_object->endDate;
	$pictures = $php_object->pictures;
	
	if ($exhibition->id == 0) {
		$artist->id = DAOFactory::getExhibitionDAO()->insert($exhibition);
	} else {
		DAOFactory::getExhibitionDAO()->update($exhibition);
	}
	
	if (count($pictures)>0) {
		DAOFactory::getExhibitionPictureDAO()->deleteByExhibition($exhibition->id);
		foreach ($pictures as $picture) {
			$exhibitionPicture = new ExhibitionPicture();
			$exhibitionPicture->exhibitionId = $exhibition->id;
			$exhibitionPicture->pictureId = $picture->id;
			DAOFactory::getExhibitionPictureDAO()->insert($exhibitionPicture);
		}
	}
}
	

function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}
