<?php 
include_once '../../Classes/include_dao.php';

$id = isset($_GET["id"])?$_GET["id"]:0;
$isEdit = isset($_GET["edit"])?$_GET["edit"]:$id==0;
if ($id==0) {
	$picture = new Picture();
	$picture->id = 0;
	$picture->status = "pending";
	
} else {
	$picture = DAOFactory::getPictureDAO()->load($id);
	
}
$artists = DAOFactory::getArtistDAO()->all();
$status = DAOFactory::getStatusDAO()->queryAll();
?>
<div class="row picture" data-id="<?php echo $picture->id;?>">
	<div class="page-element">
		<div><img class="picture-medium" src="" title="navn" /></div>
		<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="pages/ajax_file_upload.php">
			<input type=file name="picture_path" id="picture_path" accept=".jpg,.png,.jpeg" placeholder="valg bilde" value="<?php echo $picture->path?>"/>
			<div id="loader" style="display: none;">opplastes til serveren</div>
			<div id="picture-error"></div>
			<input type="submit" class="btn" >
		</form>
	</div>
	<div class="page-element">
		<input type=text class="name picture" placeholder="navn" value="<?php echo $picture->name;?>" />
	</div>
	<div class="page-element">
		<select class="artist picture">
			<?php foreach ($artists as $artist) {?>
			<option value="<?php echo $artist->id;?>"><?php echo $artist->name;?></option>
			<?php }?>
		</select>
	</div>
	<div class="page-element">
		<input type=text class="shortdescr picture" placeholder="kort beskrivelse" value="<?php echo $picture->shortDescr?>" />
	</div>
	<div class="page-element">
		<textarea class="longdescr picture" placeholder="lang beskrivelse"><?php echo $picture->longDescr;?></textarea>
	</div>
	<div class="page-element">
		<input type=text class="price picture" placeholder="pris eg 2000kr" value="<?php echo $picture->price;?>" />
	</div>
	<div class="page-element">
		<input type=text class="keywords picture" placeholder="eg titel;kunstner;" value="<?php echo $picture->keywords;?>" />
	</div>
	<div class="page-element">
		<select class="status picture">
		<?php foreach ($status as $s) {?>
			<option value="<?php echo $s->status;?>" <?php echo ($s->status == $picture->status?"selected":"");?>><?php echo $s->description;?>
			</option>
		<?php }?>
		</select>
	</div>   
	<a href="#edit" class="btn save" data-id="0"><span class="glyphicon glyphicon-floppy-save"></span></a>
	<a href="#main" class="btn detail nav"><span class="glyphicon glyphicon-menu-up"></span></a>
</div>
<script>
	var isEdit = <?php echo $isEdit ?>==1;
	$(function(){
			$("input.picture,textarea.picture").disabled = !isEdit;

			$(".picture a.btn.save").on("click",function() {
				
			});

			function savePicture(picture) {
				var picture = {
						id : $(".row.picture").attr("data-id"),
						artistid : $(".page-element.artist.picture").val(),
						name : $(".page-element input.name.picture").val(),
						shortDescr : $(".page-element input.shortdescr.picture").val(),
						longDescr : $(".page-element input.longdescr.picture").val(),
						price : $(".page-element input.longdescr.price").val(),
						keywords : $(".page-element input.keywords.picture").val(),
						status : $(".page-element select.status.picture").val()
				};
				var obj = { js_object : JSON.stringify(picture)};
				$.ajax({
		    	       dataType: 'json',
		    	       url: "ajax_save_picture.php",
		    	       method: "POST",
		    	       data: obj,
		    	       success: function(xhr) {
		    	           if (picture.id == 0) {
		    	        	   picture.id = xhr.id;
		    	           } 
		    	           loadContent("pages/picture_entries.php?artistid="+picture.artistId,$("#Picture-Entries"));
		    	       },
		    	       error: function(xhr) {
		    	           alert(xhr.errorText);
		    	       }
		    	   });
			}
	});
</script>
<script type="text/javascript" src="js/ajax_upload.js"></script>