<head>
	<?php include_once '../../head.php';?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.form.min.js"></script>
</head>
<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="ajax.php">
				<div class="form-group">
					<p>Please Choose Image: </p>
					<input class='file' type="file" class="form-control" name="images" id="images" placeholder="Please choose your image">
					<span class="help-block"></span>
				</div>
				<div id="loader" style="display: none;">
					Please wait image uploading to server....
				</div>
				<input type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
			</form>