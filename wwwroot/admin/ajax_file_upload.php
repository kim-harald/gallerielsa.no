<?php
include_once "/../classes/include_dao.php";

$data = array();
if( isset( $_POST['image_upload'] ) && !empty( $_FILES['images'] )){
	
	$image = $_FILES['images'];
	$allowedExts = array("gif", "jpeg", "jpg", "png");

	$image_name = $image['name'];
	//get image extension
	$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
	//assign unique name to image
	$name = time().'.'.$ext;
	//$name = $image_name;
	//image size calcuation in KB
	$image_size = $image["size"] / 1024;
	$image_flag = true;
	//max image size
	$max_size = 20000;
	if( in_array($ext, $allowedExts) && $image_size < $max_size ){
		$image_flag = true;
	} else {
		$image_flag = false;
		$data['error'] = 'Maybe '.$image_name. ' exceeds max '.$max_size.' KB size or incorrect file extension';
	} 
	
	if( $image["error"] > 0 ){
		$image_flag = false;
		$data['error'] = '';
		$data['error'].= '<br/> '.$image_name.' Image contains error - Error Code : '.$image["error"];
	}
	
	if($image_flag){
		move_uploaded_file($image["tmp_name"], "../pictures/".$name);
		$picture = new Picture();
		$picture->path = "/pictures/".$name;
		$id = isset($_POST["pictureid"])?$_POST["pictureid"]:0;
		$id == "" ? 0 : $id; 
		if (is_numeric($id)) {
			
			$picture = DAOFactory::getPictureDAO()->load($id);
			$picture->path = "/pictures/".$name;
			//DAOFactory::getPictureDAO()->update($picture);
		} else {
			$picture->id = DAOFactory::getPictureDAO()->insert($picture);
		}
		$data['success'] = $picture;
	}
	
	echo json_encode($data);
	
} else {
	$data[] = 'No Image Selected..';
}
?>