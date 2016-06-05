<!DOCTYPE html>
<html>
<head>
<?php 
		include("head.php");
		
		$id = isset($_GET["id"])?$_GET["id"]:0;
		
		$exh = DAOFactory::getExhibitionDAO()->load($id);
		$pictures = DAOFactory::getPictureDAO()->queryByExhibition($id);
?>
<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css">
  
<script type="text/javascript" src="js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.pack.js"></script>
</head>
<body>
	<div class="container">
<?php include("header.php"); ?>
	  <div id="Body" class="container-fluid">
        
	  	<div class="col-sm-3 col-md-3"></div>
      <div class="row">
	      <div class="col-xs-12 col-sm-6 col-md-6">
	      <h3><?php echo $exh->name?></h3>
	      <h4><?php echo $exh->startDate?> til <?php echo $exh->endDate?></h4>
	      <p><?php echo $exh->longDescr?></p>
	      <div id="ExhibitionPictures">
	      	
	<?php foreach($pictures as $p) {?>
	      		<a class="fancybox-button" rel="fancybox-button" href="<?php echo $p->path?>" title = '<?php echo $p->name?>'>
	      			<img src="<?php echo $p->thPath?>" alt="" />
	      		</a>
	<?php }?>
					
	      </div>
      </div>     
      <div class="col-sm-3 col-md-3">gg</div>

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