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
      
      <div class="row">
      	<div class="col-sm-3 col-md-3"></div>
	      <div class="col-xs-12 col-sm-6 col-md-6">
	      <?php foreach($exhibitions as $exh) {
	      	$picture = DAOFactory::getPictureDAO()->queryGetFirstPicture($exh->id);
	      	$startDate = new DateTime($exh->startDate);
	      	$endDate = new DateTime($exh->endDate);
	      ?>
	      <div class="item-container">
			    <div class="image-container">
				    <img class="thumbnail <?php echo $picture->aspect?>" alt="<?php echo $picture->name?>" src="<?php echo $picture->thPath?>">
			    </div>
			    <div class="text-container center">
				    <p><?php echo $exh->name?></p>
				    <p><?php echo $startDate->format("d.m.y") . ' til ' . $endDate->format("d.m.y")?></p>
			    </div>
	    	</div>
        <?php } ?>
      </div>     
      <div class="col-sm-3 col-md-3"></div>

		</div>
<?php include 'footer.php'?>
  </div>
  <script>
		$(function(){
			$(".fancybox-button").fancybox({
				prevEffect		: 'none',
				nextEffect		: 'none',
				closeBtn		: true,
				helpers	: {
					title	: {
						type: 'outside'
					},
					thumbs	: {
						width	: 50,
						height	: 50
					}
				}
			});
		});
  </script>
</body>
</html>
