<?php
include_once '/../../Classes/include_dao.php';

$id = isset($_GET["id"])?$_GET["id"]:0;

if ($id>0) {
	$picture = DAOFactory::getPictureDAO()->delete($id);
	echo json_encode($picture);
} 
 
?>