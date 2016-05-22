<?php
	include_once '../../Classes/include_dao.php';
	
	$exhibitionId = isset($_GET["exhibitionid"]) ? $_GET["exhibitionid"] : 0;
	
	$pictures = DAOFactory::getPictureDAO()->all();
	$exhibitionPictures = DAOFactory::getExhibitionPictureDAO()->queryByExhibition($exhibitionId);
	
	$artists = DAOFactory::getArtistDAO()->all();
	
?>


<div id="PictureSelect" class="form-container">
	<div class="row selected">
		<div class="picture-element">
			<img alt="" src="">
			<p></p>
			<p></p>
		</div>
	</div>
	<div class="row">
		<select id="ArtistFilter">
			<?php foreach ($artists as $a) {?>
			<option value="<?php echo $a.id;?>"><?php echo $a.name;?></option>
			<?php }?>
		</select>
	</div>
	<div class="row unselected">
		<?php foreach($pictures as $p) {?>
		<div class="picture-element" data-pictureid="<?php echo $p.id?>" data-artistid="<?php echo $p.artistid?>">
			<img alt="<?php echo p.name?>" src="<?php echo p.path?>" title="<?php echo p.name?>">
			<p><?php echo p.name?></p>
		</div>
		<?php }?>
	</div>
	<div class="row">
		<a class="btn save">lagre</a>
		<a class="btn cancel">avbryt</a>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#ArtistFilter option").on("click",function(){
			
		});
	});
</script>