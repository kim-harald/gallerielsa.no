<!DOCTYPE html>
<html>
<head>
<title>Kunstnere</title>
<?php 
		include("head.php");
		$id = isset($_GET["id"])?$_GET["id"]:0;
		
		$artist = DAOFactory::getArtistDAO()->load($id);
		$pictures = DAOFactory::getPictureDAO()->queryByArtist($id);
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="js/fancybox/jquery.fancybox.css">
    <script type="text/javascript" src="js/jquery.bpopup.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.js"></script>
		<script type="text/javascript" src="js/fancybox/jquery.fancybox.js"></script>
		<script type="text/javascript" src="js/fancybox/jquery.fancybox.pack.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-buttons.js"></script>
</head>
<body>
	<div id="Body" class="container-fluid">
	<?php include "header.php"?>
	<section class="ui_page active" id="main">
		<div class="row">
			<div class="col-sm-3 col-md-3"></div>
			<div class="page-element">
				<?php $path = $artist->profilePicturePath=='' ? $pictures[0]->path:$artist->profilePicturePath?>
				<h3><?php echo $artist->firstname . " " . $artist->lastname?></h3>
				<img class="profile thumbnail" src="<?php echo $path?>">
				<div class="artist-description"><?php echo $artist->longDescr?></div>
			</div>
		</div>
		<div class="row">
		<div class="col-sm-3 col-md-3"></div>
		<?php
			foreach ($pictures as $picture) {
		?>
			<div class="page-element">
				<a class="fancybox-button" rel="fancybox-button" href="<?php echo $picture->path?>">
					<img class="thumbnail" src="<?php echo $picture->thPath?>">
					<p><?php echo $picture->name?></p>
				</a>
			</div>
		<?php }?>
		</div>
		</section>
	</div>
	<script>
		$(function(){
			$(".fancybox-button").fancybox({
				width: "100%",
				prevEffect		: 'none',
				nextEffect		: 'none',
				arrows : true,
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

			$(".fancybox-wrap").swipe({
				swipe : function(event, direction) {
					alert(direction);
				}
			});

// 			$('.fancybox-button').fancybox({
// 		        width: "100%",
// 		        margin: [0, 0, 0, 0],
// 		        padding: [0, 0, 0, 0],
// 		        openEffect  : 'none',
// 		        closeEffect : 'none',
// 		        prevEffect : 'fade',
// 		        nextEffect : 'fade',
// 		        closeBtn  : false,
// 		        arrows: true,
// 		        helpers : {
// 		            title : null,
// 		            overlay : {
// 		                css : {
// 		                    'background' : 'rgba(0, 0, 0, 0.95)' 
// 		                }
// 		            },
// 		            buttons : {
// 		            }

// 		        },
// 		        afterShow: function() {
// 		            $('.fancybox-wrap').swipe({
// 		                swipe : function(event, direction) {
// 		                    if (direction === 'left' || direction === 'up') {
// 		                        $.fancybox.prev( direction );
// 		                    } else {
// 		                        $.fancybox.next( direction );
// 		                    }
// 		                }
// 		            });

// 		        },

// 		        afterLoad : function() {
// 		        }
// 		    });

			setMenuActive("artists");
		});
  </script>
</body>
</html>