<!DOCTYPE html>
<html>
<head>
<?php 
		include("head.php");
		include_once '/utilities/common.php';
		?>
<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css">
  
<script type="text/javascript" src="js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
$(function(){
	setMenuActive("events");
});
</script>
</head>
<body>
	<div class="container">
<?php include("header.php"); ?>
	  <div id="Body" class="container-fluid">

<?php 
include 'pages/event_entries.php';
include 'footer.php'?>
  </div>
  <script>
		$(function(){
			setMenuActive("events");
		});
  </script>
</body>
</html>
