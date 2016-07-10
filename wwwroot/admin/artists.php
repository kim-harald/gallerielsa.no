<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>kunstner</title>

<?php
	include("../head.php");
	//$langCode = getDefaultLanguage();
	$artists = DAOFactory::getArtistDAO()->all();
?>
	<link rel="stylesheet" href="../jodit/jodit.min.css">
	<script src="../jodit/jodit.min.js"></script>
	<link rel="stylesheet" href="css/styles.css">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/artists.js"></script>
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<script type="text/javascript" src="js/ajax_upload.js"></script>
</head>
<body>
    

<?php include "header.php"?>
<div class="container-fluid site-container"">

<section class="ui_page active" id="main">
	<div class="row add">
		<div class="artist-element">
			<a href="#detail" data-id="0" class="nav btn detail">
				<img class="thumbnail" src="../images/artist-icons-71126_add.png">
			</a>
		</div>
	</div>
	<div class="row">
	<?php 
	foreach($artists as $artist) {
	
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
			'"data-profilepicturepath="'. $imgPath .
			'" data-createddate="' . $artist->createdDate . '"' .
		'" data-deleteddate="' . $artist->deletedDate . '"'
		?>
	  <div class="artist-element" <?php echo $data?>">
  		<a href="#detail?id=<?php echo $artist->id?>" data-id="<?php echo $artist->id?>" class="nav detail">
	  		<img class="thumbnail" alt="<?php echo $artist->name; ?>" src="<?php echo $imgPath?>">
	  		<p class="artist-name"><?php echo $artist->firstname . " " . $artist->lastname ; ?></p>
	  		<p class="artist-pictures"><?php echo isset($artist->numPictures)?$artist->numPictures:0?></p>
  		</a>
  	 </div>
  <?php }?>
	</div>
</section>

<section class="ui_page" id="detail">
    <h1>rediger kunstner</h1>
    <div class="ui_content" data-id="1" >
        <div class="artist-field">
        	<label for="artist-firstname">fornavn</label><br/>
        	<input type="text" name="artist-firstname" class="artist-firstname" placeholder="fornavn" value=""/>
        </div>
        <div class="artist-field">
        	<label for="artist-lastname">etternavn</label><br/>
        	<input type="text" name="artist-lastname" class="artist-lastname" placeholder="etternavn" value=""/>
        </div>
        <div class="artist-field">
        	<label for="artist-shortdescr">beskrivelse</label><br/>
        <input type="text" name="artist-shortdescr" class="artist-shortdescr" placeholder="kort beskrivesle" value=""/>
        </div>
        <div class="artist-field">
        	<label for="artist-longdescr">lang beskrivelse</label><br/>
        	<textarea id="Artist-longdescr" name="artist-longdescr" class="artist-longdescr" placeholder="lang beskrivelse"></textarea>
        </div>
        <div class="artist-field">
        	<div class="hide">
        	<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="ajax_file_upload.php">
						<div class="form-group">
							<p>Velg bilde: </p>
							<input  style="display: none" class='file' type="file" class="form-control" name="images" id="images" placeholder="Please choose your image">
							<span class="help-block"></span>
						</div>
						<input style="display: none" type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
						<input type="hidden" name="isProfile" value=true>
					</form>
					</div>
					<div>
						<div class="artist-profile">
							<img id="Path" src="" class="artist-profile thumbnail">							
						</div>
						<div class="profile-chooser">
							<a id="Choose" class="btn btn-default">Nye profil bilde</a>
							<img id="loader" src="../images/ajax-loader.gif"></img>
						</div>
					</div>
				</div>
				<a href="#main" class="btn btn-default save" data-id="1">lagre</a>
				<a href="#main" class="btn btn-default delete" data-id="1">slett</a>
				<a href="#main" data-id="1" class="btn btn-default nav">tilbakke</a>
			</div>
			
    
</section>

<section class="ui_page" id="pictures">
    <h1>bilder</h1>
    <div class="ui_content" data-id="1" >
        <!-- <img src="th_picture1.jpg" class="picture-thumbnail" />
        <img src="th_picture2.jpg" class="picture-thumbnail" />
        <img src="th_picture3.jpg" class="picture-thumbnail" />
        <img src="th_picture4.jpg" class="picture-thumbnail" /> -->
        <a href="#main">back</a>    
    </div>
</section>
</div>
<div id="AjaxSpinner" class=""></div>
</body>
</html>
