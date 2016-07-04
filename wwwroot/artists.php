<!DOCTYPE html>
<html>
<head>
<title>Kunstnere</title>
<?php 
		include("head.php");
		$artists = DAOFactory::getArtistDAO()->all();
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"/>
    <script type="text/javascript" src="js/jquery.bpopup.min.js"></script>
    <script type="text/javascript">
			$(function(){
				setMenuActive("artists");
			});
    </script>
</head>

<body>
	<?php include "header.php"?>
	<div id="Body" class="container-fluid">
	<h3>kunstnere</h3>
	
	<section class="ui_page active" id="main">
		<div class="row">
			
		<?php 
	foreach($artists as $artist) {
		if ($artist->numPictures > 0) {
		$imgPath = $artist->profilePicturePath;
			if ($artist->profilePicturePath=='' || $artist->profilePicturePath==null) {
			
				$imgPath = $artist->profilePicturePath !='' ? $artist->profilePicturePath : $artist->picturePath;
				$imgPath = $imgPath != '' ? $imgPath : '/images/artist-icons-71126.png';
			} 
			$data = 'data-id="'. $artist->id . 
				'" data-shortdescr="' . $artist->shortDescr . 
				'" data-longdescr="' .	$artist->longDescr . 
				'" data-firstname="' .	$artist->firstname . 
				'" data-lastname="' .	$artist->lastname . 
				'" data-createddate="' . $artist->createdDate . '"' .
			'" data-deleteddate="' . $artist->deletedDate . '"'
		?>
	  <div class="artist-element" <?php echo $data?>">
  		<a href="artist.php?id=<?php echo $artist->id?>" data-id="<?php echo $artist->id?>" class="nav detail">
	  		<img class="thumbnail" alt="<?php echo $artist->name; ?>" src="<?php echo $imgPath?>">
	  		<p class="artist-name"><?php echo $artist->firstname . " " . $artist->lastname ; ?></p>
	  		<p class="artist-pictures"><?php echo $artist->numPictures." bilde".($artist->numPictures > 1 ?"r":"")?></p>
  		</a>
  	 </div>
  	 
  <?php
			}
		}?>
			
		</div>
		</section>
	</div>
	
</body>
</html>