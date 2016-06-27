<html>
<head>
	<?php include_once '../../head.php';?>
	<script type="text/javascript" src="../js/jquery.form.min.js"></script>
	<script type="text/javascript" src="../js/ajax_upload.js"></script>
	<script type="text/javascript" src="../js/common.js"></script>
		
</head>
	<body>
		<div>
		<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="../ajax_file_upload.php">
			<div class="form-group">
				<p>Please Choose Image: </p>
				<input  style="display: none" class='file' type="file" class="form-control" name="images" id="images" placeholder="Please choose your image">
				<span class="help-block"></span>
			</div>
			<div id="loader" style="display: none;">
				Please wait image uploading to server....
			</div>
			<input style="display: none" type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
			<input type="hidden" name="isProfile" value=true>
		</form>
		</div>
		<div>
			<img id="Path" style="width:100px;min-height:100px">
			<button id="Choose">Velg</button>
			<button id="Upload">Last opp</button>
			<a class="btn btn-default nav save">lagre</a>
			<p id="filename"></p>
		</div>
	</body>
	<script>
	$(function(){
		FileUploadWrapper($("#Upload"),$("#Choose"),$("#filename"));

	});
	
	var FileUploadWrapper = (function($submitBtn, $chooseBtn, $filename) {
        $chooseBtn.on("click", function() {
            $("form input[type=file]").click();
        });
        $("form input[type=file]").on("change", function() {
            $filename.text($(this).val());
        });

        $submitBtn.on("click", function() {
            $("form input[type=submit]").click();
        });
    });
	</script>
</html>