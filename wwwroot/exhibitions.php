<!DOCTYPE html>
<html>
<head>
<?php 
		include("head.php");
		include_once '/utilities/common.php';
		
		$id = isset($_GET["id"])?$_GET["id"]:0;
		
		$exhibitions = DAOFactory::getExhibitionDAO()->queryAll();
		?>
<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css">
  
<script type="text/javascript" src="js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.pack.js"></script>
</head>
<body>
	<div class="container">
<?php include("header.php"); ?>
	  <div id="Body" class="container-fluid">
	  	<h3>utstillinger</h3>
<?php 
include 'pages/exhibition_entries.php';
include 'footer.php'?>
  </div>
  <script>
		$(function(){
			setMenuActive("exhibitions");
		});
  </script>
</body>
</html>
