<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
	include_once "../utilities/common.php";
	
	//$langCode = getDefaultLanguage();
	$artists = DAOFactory::getArtistDAO()->all();
	$artistId = isset($_GET["id"])?$_GET["id"]:0;
	if (isset($artistId) && $artistId > 0) {
		$pictures = DAOFactory::getPictureDAO()->queryByArtist($artistId);
	} else {
		$pictures = DAOFactory::getPictureDAO()->queryAll();
	}
	
	$status = DAOFactory::getStatusDAO()->queryAll();
	$ts =time();
?>
	<link rel="stylesheet" href="../jodit/jodit.min.css">
	<script src="../jodit/jodit.min.js"></script>
	<link rel="stylesheet" href="css/styles.css">
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<script type="text/javascript" src="js/ajax_upload.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/pictures.js"></script>
</head>
<body>
 
<?php include "header.php"?>
<div class="container-fluid site-container">
<section class="ui_page active" id="main">
	<div class="row add">
		<div class="picture-element">
			<a href="#detail?id=0" data-id="0" class="btn nav add">
				<img class="thumbnail" alt="Ny bilde" src="../images/art-icon-add.png" />
	  		<p>Ny bilde</p>
  		</a>
    </div>
  </div>
  <div class="row">
<?php foreach ($pictures as $picture) {	?>
	<div class="picture-element" data-id="<?php echo $picture->id?>">
		<a href="#detail?id=<?php echo $picture->id?>" data-id="<?php echo $picture->id?>" class="nav detail">
			<img class="thumbnail <?php echo isset($picture->aspect)?$picture->aspect:"landscape"?>" 
				alt='<?php echo $picture->name?>' 
				src="<?php echo (isset($picture->thPath)?$picture->thPath:$picture->path)."?ts=".$ts ?>" 
				data-id="<?php echo $picture->id?>" />
			<p><?php echo $picture->name?></p>
		</a>
	</div>
<?php }?>
</div>
</section>

<section class="ui_page" id="detail">
	<div class="row picture" data-id="0">
		<div class="col-sm-6 col-md-6">
		<div class="page-fields-container">
			
				<div class="hidden">
					<div id="ThPath"></div>
					<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="ajax_file_upload.php">
						<input type=file name="images" id="images" accept=".jpg,.png,.jpeg" placeholder="valg bilde" data-id="0" value=""/>
						<input type=hidden name="pictureid" id="pictureid" />
						<input type=hidden name="Rotation" id="Rotation" />
						
						<div id="picture-error"></div>
						<input type="submit" class="btn btn-primary" value="opplast" id="image_upload" name="image_upload">
					</form>
				</div>
				<div class="page-element image-upload">
					<div class="new-picture">
						<img id="Path" src="" class="">							
					</div>
					<div class="upload-controls">
						<a id="Choose" class="btn btn-default">Nye bilde</a>
						<img id="loader" src="../images/ajax-loader.gif"></img>
					</div>
					<div>
						<a id="BtnRotation" class="btn btn-default" data-id="0">Roter</a>
					</div>
			</div>
		</div>
		</div>
		<div class="col-sm-6 col-md-6">
		<div class="page-fields-container">
			<div class="page-element">
				<label for="Name">navn</label><br/>
				<input id="Name" name="Name" type=text class="name picture" placeholder="navn" />
			</div>
			<div class="page-element">
				<label for="ArtistId">kunstner</label><br/>
				<select id="ArtistId" name="ArtistId" class="artist picture">
					<?php foreach ($artists as $artist) {?>
					<option value="<?php echo $artist->id;?>"><?php echo $artist->firstname . ' ' . $artist->lastname?></option>
					<?php }?>
				</select>
			</div>
			<div class="page-element">
				<label for="ShortDescr">kort beskrivlse</label><br/>
				<input id="ShortDescr" name="ShortDescr" type=text class="shortdescr picture" placeholder="kort beskrivelse" />
			</div>
			<div class="page-element">
				<label for="LongDescr">lang beskrivelse</label><br/>
				<textarea id="LongDescr" name="LongDescr" class="longdescr picture" placeholder="lang beskrivelse"></textarea>
			</div>
			<div class="page-element">
				<label for="Price">pris</label><br/>
				<input id="Price" name="Price" type="number" min="0" class="price picture" placeholder="pris eg 2000"  /><span>kr</span>
			</div>
			<div class="page-element">
				<label for="Status">status</label><br/>
				<select id="Status" name="Status" class="status picture">
				<?php foreach ($status as $s) {?>
					<option value="<?php echo $s->status;?>"><?php echo $s->description;?>
					</option>
				<?php }?>
				</select>
			</div>   
		</div>
		</div>
	</div>
	<div class="row page-fields-container">
			<a href="#main" class="btn save btn-default" data-id="0">lagre</span></a>
			<a href="#main" class="btn nav btn-default">avbryt</a>
			<a href="#main" class="btn delete btn-default">slette</span></a>
	</div>
</section>

</div>
<div id="AjaxSpinner" class=""></div>
</body>
</html>
