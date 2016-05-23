<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
        
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
</head>
<body>
  <script type="text/javascript">
      $(function() {
          $("section.ui_page").hide();
          $("section.ui_page.active").show();
          loadContent("pages/picture_entries.php",$("#Picture-Entries"),setEvents);
          $("#imageform").hide();
      });

      function setEvents() {
    	  $("a.nav").on("click", function() {
              var pageRef = $(this).attr("href");
              setSection(pageRef);
          });

          $("a.detail").on("click", function() {
              var id = $(this).attr("data-id");
              getDetails(id);
              $("section#detail .row.picture,a.btn.save").attr("data-id",id);
              
          });

          $("section#detail .picture a.btn.save").on("click",function() {
						savePicture();
					});

					$("a.btn.delete").on("click",function(){
						var id = $(this).attr("data-id");
						deletePicture(id);
					});

					$("#CheckUpload").on("change",function(){
            if($(this).is(":checked")){
                $("#imageform").show();
            }
            else if($(this).is(":not(:checked)")){
            	$("#imageform").hide();
            }
					});
			
      }

      function getDetails(id) {
        setSpinner();
        if (id==0) {
        	$("#CheckUpload").attr("checked","");
        	$("#imageform").show();
        }
    	  $.ajax({
   	       dataType: 'json',
   	       url: "pages/ajax_picture.php?verb=get&id="+id,
   	       method: "GET",
   	       success: function(xhr) {
   	    	 		 displayDetails(xhr);
   	    	 		 $("input.picture,textarea.picture").disabled = (xhr.id == 0);
   	       },
   	       error: function(xhr) {
   	           alert(JSON.stringify(xhr));
   	       },
		   	   complete: function(xhr) {
		        	clearSpinner();
        	 }
   	   });
      }

      function displayDetails(p) {
          var $e = $(".page-element");
          $("#Path").attr("src",p.path);
          $("#ThPath").text(p.thPath),
          $("#Name").val(p.name);
          $("#ShortDescr").val(p.shortDescr);
          $("#LongDescr").val(p.longDescr);
          $("#ArtistId").val(p.artistid);
          $("#Price").val(p.price);
          $("#Dimensions").val(p.dimensions);
          $("#Keywords").val(p.keywords);
          $("#Status").val(p.status);
          $("#images").attr("data-id",p.id);
          $("#pictureid").val(p.id);
          $("a.btn.delete").attr("data-id",p.id);
      }
                

      function savePicture() {
			var picture = {
					id : $("section#detail .row.picture").attr("data-id"),
					artistid : $("#ArtistId").val(),
					name : $("#Name").val(),
					shortDescr : $("#ShortDescr").val(),
					longDescr : $("#LongDescr").val(),
					price : $("#Price").val(),
					dimensions : $("#Dimensions").val(),
					keywords : $("#Keywords").val(),
					status : $("#Status").val(),
					path : $("#Path").attr("src"),
          thPath : $("#ThPath").text()
			};
			var obj = { js_object : JSON.stringify(picture)};
			setSpinner();
			$.ajax({
	    	       dataType: 'json',
	    	       url: "pages/ajax_picture.php?verb=post",
	    	       method: "POST",
	    	       data: obj,
	    	       success: function(xhr) {
	    	           if (picture.id == 0) {
	    	        	   picture.id = xhr.id;
	    	           } 
	    	           loadContent("pages/picture_entries.php?artistid="+picture.artistId,$("#Picture-Entries"),setEvents);
	    	           
	    	       },
	    	       error: function(xhr) {
	    	           alert(JSON.stringify(xhr));
	    	       },
	    	       complete: function(xhr) {
	    	        	clearSpinner();
	    	       }
	    	});
      }

      function deletePicture(id) {
          setSpinner();
    			$.ajax({
      	       dataType: 'json',
      	       url: "pages/ajax_picture.php?verb=delete&id="+id,
      	       method: "GET",
      	       success: function(xhr) {
      	    	 		loadContent("pages/picture_entries.php",$("#Picture-Entries"),setEvents);
      	       },
      	       error: function(xhr) {
      	           alert("Error! : "+JSON.stringify(xhr));
      	       },
      	       complete: function(xhr) {
         	       	clearSpinner();
             	 }
      		});
      }
			
 
</script>
<div class="container-fluid  site-container">
<section class="ui_page active" id="main">
    <div class="add">
        <div class="picture-element">
            <a href="#detail" data-id="0" class="btn nav detail">
	  		    <img class="picture-element" alt="Ny bilde" src="../images/art-icon-add.png" />
	  		    <p>Ny bilde</p>
  		    </a>
        </div>
    </div>
    <div id="Picture-Entries"></div>
</section>

<section class="ui_page" id="detail">
	<div class="row picture" data-id="0">
		<div class="page-element">
			<div><img id="Path" class="picture-medium" src="" title="navn" /></div>
			<div class="hidden" id="ThPath"></div>
			<label for="CheckUpload">Opplast ny bilde</label>
			<input type="checkbox" id="CheckUpload" name="CheckUpload">
			<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="ajax_file_upload.php">
				<input type=file name="images" id="images" accept=".jpg,.png,.jpeg" placeholder="valg bilde" data-id="0" />
				<input type=hidden name="pictureid" id="pictureid" />
				<div id="loader" style="display: none;">opplastes til serveren</div>
				<div id="picture-error"></div>
				<input type="submit" class="btn btn-primary" value="opplast" id="image_upload" name="image_upload">
			</form>
		</div>
		<div class="page-element">
			<input id="Name" type=text class="name picture" placeholder="navn" />
		</div>
		<div class="page-element">
			<select id="ArtistId" class="artist picture">
				<?php foreach ($artists as $artist) {?>
				<option value="<?php echo $artist->id;?>"><?php echo $artist->name;?></option>
				<?php }?>
			</select>
		</div>
		<div class="page-element">
			<input id="ShortDescr" type=text class="shortdescr picture" placeholder="kort beskrivelse" />
		</div>
		<div class="page-element">
			<textarea id="LongDescr" class="longdescr picture" placeholder="lang beskrivelse"></textarea>
		</div>
		<div class="page-element">
			<input id="Price" type=text class="price picture" placeholder="pris eg 2000kr"  />
		</div>
		<div class="page-element">
			<input id="Dimensions" type=text class="dimensions picture"  placeholder="eg 60 x 40cm" />
		</div>
		<div class="page-element">
			<input id="Keywords" type=text class="keywords picture" placeholder="eg titel;kunstner;" />
		</div>
		<div class="page-element">
			<select id="Status" class="status picture">
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
</section>

</div>
<div id="AjaxSpinner" class=""></div>
</body>
</html>
