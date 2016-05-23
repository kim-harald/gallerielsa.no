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
		$picture->thPath = "/pictures/"."th_".$name;
		createThumbnail("../pictures/".$name, "../pictures/th_".$name, 150,150);
		$id = isset($_POST["pictureid"])?$_POST["pictureid"]:0;
		$id == "" ? 0 : $id; 
		if (is_numeric($id)) {
			
			$picture = DAOFactory::getPictureDAO()->load($id);
			$picture->thPath = "/pictures/th_".$name;
			$picture->path = "/pictures/".$name;
			DAOFactory::getPictureDAO()->update($picture);
		} else {
			$picture->id = DAOFactory::getPictureDAO()->insert($picture);
		}
		
		
		$data['success'] = $picture;
	}
	
	echo json_encode($data);
	
} else {
	$data[] = 'No Image Selected..';
}


function createThumbnail($filepath, $thumbpath, $thumbnail_width, $thumbnail_height) {
    list($original_width, $original_height, $original_type) = getimagesize($filepath);
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);

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

    $old_image = $imgcreatefrom($filepath);
    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
    $imgt($new_image, $thumbpath);

    return file_exists($thumbpath);
}

?>