<?php 
	include_once("../classes/include_dao.php");
	$artistId = 1;
	$artist = DAOFactory::getArtistDAO()->load($artistId);
	$pictures = DAOFactory::getPictureDAO()->queryByArtist($artistId);
	$profilePicture = DAOFactory::getPictureDAO()->load($artist->profilePictureId);
	
?>
<!DOCTYPE html>
<html>
<head>
<?php 
	include '../head.php';
?>
<style>
.btn-group img {
	width:20px;
}
</style>
</head>
<body>
<div class="btn-group" style="margin:10px;">    <!-- CURRENCY, BOOTSTRAP DROPDOWN -->
<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	<img data-id="<?php echo($profilePicture->id);?>" src="<?php echo($profilePicture->path);?>" /> <?php echo($profilePicture->name)?>
</a>
<ul class="dropdown-menu">
	<li>
		<a href="javascript:void(0);" class="new-picture">New picture</a>
	</li>
	<?php 
		foreach ($pictures as $picture) {
	?>
	<li>
		<a href="javascript:void(0);">
			<img data-id=<?php echo($picture->id);?> src="<?php echo($picture->path);?>" /> <?php echo($picture->name);?>
		</a>
	</li>
	<?php
		}
	?>
</ul>
</div>

<script>
$(function(){
	$(".dropdown-menu a.new-picture").click(function() {
		var html = "<input class=upload type=file><input class='btn-secondary upload' type=button value=cancel><input class='btn-primary upload' type=button value=save>";
		$(this).parents('.btn-group').find('.dropdown-toggle').hide();
		$(this).parents('.btn-group').append(html);
		$(this).parents('.btn-group').find("input.btn-secondary").click(function() {
			$(this).parents('.btn-group').find('.dropdown-toggle').show();
			$(this).parents('.btn-group').find('input.upload').remove();
		});
	});
	$(".dropdown-menu li a").click(function () {
    var selText = $(this).text();
    var imgSource = $(this).find('img').attr('src');
    var imgId = $(this).find('img').data('id');
    var img = '<img data-id="' + imgId +'" src="' + imgSource + '"/>';        
    $(this).parents('.btn-group').find('.dropdown-toggle').html(img + ' ' + selText + ' <span class="caret"></span>');
	});
});
/* BOOTSTRAP DROPDOWN MENU - Update selected item text and image */

</script>
</body>
</html>