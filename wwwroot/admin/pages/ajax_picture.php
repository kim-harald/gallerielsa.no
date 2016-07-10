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
    $result = post($_POST);
    break;
  case "ROTATE" :
  	$result = rotate($id);

}


echo json_encode($result);


/************************************************************************************/
function get($id) {
  if ($id==0) {
		$picture = new Picture();
		$picture->name = "";
		$picture->id = 0;
		$picture->artistid = "";
		$picture->longDescr = "";
		$picture->shortDescr = "";
		$picture->path = "";
		$picture->thPath = "";
		$picture->price = 0;
		$picture->status = "";
		$picture->aspect = "";
	} else {
		$picture = DAOFactory::getPictureDAO()->load($id);
		$picture->longDescr = htmlspecialchars_decode($picture->longDescr);
		
  }
  
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

  $picture = new Picture();
  $picture->name = $php_object->name;
  $picture->id = $php_object->id;
  $picture->artistid = $php_object->artistid;
  
  $picture->longDescr = htmlspecialchars($php_object->longDescr);
  $picture->shortDescr = $php_object->shortDescr;
  $picture->path = $php_object->path;
  $picture->thPath = $php_object->thPath;
  $picture->price = $php_object->price;
  $picture->status = $php_object->status;
  $picture->aspect = getAspect($php_object->path);
  
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

function rotate($id) {
	
	$picture = get($id);
	
	$rotation = isset($_GET["rotation"]) ? $_GET["rotation"] : 0;
	if ($rotation > 0) {
		rotateImage("../..".$picture->path, $rotation);
		rotateImage("../..".$picture->thPath, $rotation);
	}
	$picture->aspect = getAspect($picture->path);
	DAOFactory::getPictureDAO()->update($picture);
	return $picture;
}

function rotateImage($filePath,$rotation) {
	list($original_width, $original_height, $original_type) = getimagesize($filePath);

	if ($original_type === 1) {
		$imgt = "ImageGIF";
		$imgcreatefrom = "ImageCreateFromGIF";
	} else if ($original_type === 2) {
		$imgt = "ImageJPEG";
		$imgcreatefrom = "ImageCreateFromJPEG";
	} else if ($original_type === 3) {
		$imgt = "ImagePNG";
		$imgcreatefrom = "ImageCreateFromPNG";
	} else {
		return false;
	}
	$old_image = $imgcreatefrom($filePath);
	$new_image = imagerotate($old_image,$rotation,0);
	imagejpeg($new_image,$filePath);
}

function sanitize($str, $quotes = ENT_NOQUOTES){
	$str = htmlspecialchars($str, $quotes);
	return $str;
}

?>