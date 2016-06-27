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
?>
	<link rel="stylesheet" href="css/styles.css">
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<script type="text/javascript" src="js/ajax_upload.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/pictures.js"></script>
</head>
<body>
 
<?php include "header.php"?>
<div class="container-fluid  site-container">
<section class="ui_page active" id="main">
    <div class="add">
        <div class="picture-element">
            <a href="#detail?id=0" data-id="0" class="btn nav add">
	  		    <img class="picture-element" alt="Ny bilde" src="../images/art-icon-add.png" />
	  		    <p>Ny bilde</p>
  		    </a>
        </div>
    </div>
    <div id="Picture-Entries">
    	<?php include "pages/picture_entries.php"?>
    </div>
</section>

<section class="ui_page" id="detail">
	<div class="row picture" data-id="0">
		<div class="page-fields-container">
			<div class="page-element">
				<div><img id="Path" class="picture-medium new-picture" src="" title='navn' /></div>
				<div class="hidden" id="ThPath"></div>
				<label for="CheckUpload">Opplast ny bilde</label>
				<input type="checkbox" id="CheckUpload" name="CheckUpload">
				<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="ajax_file_upload.php">
					<input type=file name="images" id="images" accept=".jpg,.png,.jpeg" placeholder="valg bilde" data-id="0" value=""/>
					<input type=hidden name="pictureid" id="pictureid" />
					<div id="loader" style="display: none;">opplastes til serveren</div>
					<div id="picture-error"></div>
					<input type="submit" class="btn btn-primary" value="opplast" id="image_upload" name="image_upload">
				</form>
			</div>
		
			<div class="page-element">
				<label for="Name">navn</label>
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
			<div id="DimensionsJson" class="hidden"></div>
			<div class="page-element">
				<label for="Keywords">nøkel ord</label><br/>
				<input id="Keywords" type=text class="keywords picture" placeholder="eg titel;kunstner;" />
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
			<a href="#main" class="btn nav save btn-default" data-id="0">lagre</span></a>
			<a href="#main" class="btn nav btn-default">avbryt</a>
			<a href="#main" class="btn nav delete btn-default">slette</span></a>
		</div>

</div>
</section>

</div>
<div id="AjaxSpinner" class=""></div>
</body>
</html>
