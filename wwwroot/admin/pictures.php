<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
	//$langCode = getDefaultLanguage();
	$artists = DAOFactory::getArtistDAO()->all();
	$artistId = $_GET["id"];
	if (isset($artistId) && $artistId > 0) {
		$pictures = DAOFactory::getPictureDAO()->queryByArtist($artistId);
	} else {
		$pictures = DAOFactory::getPictureDAO()->all();
	}
	
	$status = DAOFactory::getStatusDAO()->queryAll();
?>
<link rel="stylesheet" href="css/styles.css">
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript" src="js/ajax_upload.js"></script>
</head>
<body>
  <script type="text/javascript">
      $(function() {
          $("section.ui_page").hide();
          $("section.ui_page.active").show();
          initialise()

          $("a.nav").on("click", function() {
              var pageRef = $(this).attr("href");
              set_section(pageRef);
          });

          $(".picture-element a.detail").on("click", function() {
              var id = $(this).attr("data-id");
              var picture = get_picture(id);
              display_picture(picture);
          });

          $("section#detail a.edit").on("click", function() {
              var id = $(this).attr("data-id");
              var picture = get_picture(id);
              edit_picture(picture);
          });
      });

      function get_picture(id) {
          for (i = 0; i < pictures.length; i++) {
              if (id == pictures[i].id) {
                  return pictures[i];
              }
          }
          return {
            id:0,
            name:"",
            path:"",
            shortDescr:"",
            longDescr:"",
            artistId:0
          };
      }

      function get_artist(id) {
          for (i = 0; i < artists.length; i++) {
              if (id == artists[i].id) {
                  return artists[i];
              }
          }
          return {
              id: 0,
              name: ""
          };
      }

      function display_picture(picture) {
          var artist = get_artist(picture.artistId);
          var $content = $("section#detail");
          $content.find(".row").attr("data-id", picture.id);
          $content.find(".picture-path img").attr("src", picture.path);
          $content.find(".picture-name").text(picture.name);
          $content.find(".artist-name").text(artist.name);
          $content.find(".picture-shortdescr").text(picture.shortDescr);
          $content.find(".picture-longdescr").html(picture.longDescr);
          $content.find(".picture-price").text(picture.price);
          $content.find(".picture-dimensions").text(picture.dimensions);
          $content.find("a.btn.edit").attr("data-id", picture.id);
      }

      function edit_picture(picture) {
          var artist = get_artist(picture.artistId);
          var $content = $("section#edit");
          $content.find(".row").attr("data-id", picture.id);
          $content.find(".picture-path img").attr("src", picture.path);
          $content.find("input.picture-name").val(picture.name);

          //$content.find('.picture-artist select option[value="' + picturartistId + '"]').attr("selected", true);
          $content.find('.picture-artist select').val(picture.artistId);
          $content.find("input.picture-shortdescr").val(picture.shortDescr);
          $content.find("textarea.picture-longdescr").val(picture.longDescr);
          $content.find("input.picture-price").val(picture.price);
          $content.find("input.picture-dimensions").val(picture.dimensions);
          $content.find("a.btn.save").attr("data-id", picture.id);
      }

      function save_picture(picture) {
      }

      function set_section(pageRef) {
          if (pageRef === undefined) return;
          if (pageRef.indexOf("#") < 0) return;
          $("section.ui_page.active").hide();
          $("section.ui_page.active").removeClass("active");
          $("section.ui_page" + pageRef).addClass("active");
          $("section.ui_page" + pageRef).show();
      }

      function initialise() {

          var html = $("section#main .add").html();
          html += '<div class="row">';

          for (i = 0; i < pictures.length; i++) {
              var picture = pictures[i];
              html += '<div class="picture-element center" data-id="' + picture.id + '">' +
  		          '<a href="#detail" data-id="' + picture.id + '" class="nav detail">' +
	  		      '<img alt="' + picture.name + '" src="' + picture.path + '">' +
	  		      '<p class="picture-name">' + picture.name + '</p>' +
  		          '</a>' +
  	              '</div>';
          }
          html += "</div>";
          $("section#main").html(html);

          html = '<select>';
          for (i = 0; i < artists.length; i++) {
              html += '<option value="' + artists[i].id + '">';
              html += artists[i].name;
              html += '</option>';
          }
          html += '</select>';

          $("section#edit .picture-artist").html(html);

          html= '<select>' ;
          for (i=0;i<statusMsg.length;i++) {
        			html += '<option value="' + statusMsg[i].status + '">';
              html += statusMsg[i].description;
              html += '</option>';
          }
          $("section#edit .picture-status").html(html);
      }
      
  var pictures = <?php echo json_encode($pictures); ?>;
  var artists = <?php echo json_encode($artists);?>;
  var statusMsg = <?php echo json_encode($status);?>;
 
</script>
<div class="container-fluid">
<section class="ui_page active" id="main">
    <div class="add">
        <div class="picture-element">
            <a href="#edit" data-id="0" class="btn nav add">
	  		    <img class="picture-element" alt="Ny bilde" src="../images/art-icon-add.png" />
	  		    <p>Ny bilde</p>
  		    </a>
        </div>
    </div>
    <div class="row">
        <div class="picture-element">
            <a href="#detail" data-id="0" class="nav detail">
	  		    <img alt="" src="" />
	  		    <p>name</p>
	  		    <p>0</p>
  		    </a>
        </div>
    </div>
</section>

<section class="ui_page" id="detail">
    <div class="row" data-id="0">
        <div class="picture-path">
            <img class="picture-medium" src="" title="navn" />
        </div>
        <div class="picture-name">bilde titel</div>
        <div class="artist-name">kunstner</div>
        <div class="picture-shortdescr">kort beskrivelse</div>
        <div class="picture-longdescr">lang beskrivelse</div>
        <div class="picture-price">pris</div>
        <div class="picture-dimensions">dimensjoner</div>
        <div class="picture-keywords">nøkkelord</div>
        <div class="picture-status">status</div>
        <a href="#edit" class="btn nav edit" data-id="0"><span class="glyphicon glyphicon-pencil"></span></a>
        <a href="#main" class="btn main nav"><span class="glyphicon glyphicon-menu-up"></span></a>
    </div>
</section>

<section class="ui_page" id="edit">
    <div class="row" data-id="0">
        <div class="picture-path">
            <div><img class="picture-medium" src="" title="navn" /></div>
            <form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="ajax_file_upload.php">
            	<input type=file name="picture_path" id="picture_path" accept=".jpg,.png,.jpeg" placeholder="valg bilde" />
            	<div id="loader" style="display: none;">
								opplastes til serveren
							</div>
							<div id="picture-error"></div>
            	<input type="submit" class="btn" >
            </form>
        </div>
        <div class="picture-name">
            <input type=text class="picture-name" placeholder="navn" />
        </div>
        <div class="picture-artist">
            <select/>
        </div>
        <div class="picture-shortdescr">
            <input type=text class="picture-shortdescr" placeholder="kort beskrivelse" />
        </div>
        <div class="picture-longdescr">
            <textarea class="picture-longdescr" placeholder="lang beskrivelse"></textarea>
        </div>
        <div class="picture-price">
            <input type=text class="picture-price" placeholder="pris eg 2000kr" />
        </div>
        <div class="picture-dimensions">
            <input type=text class="picture-dimensions" placeholder="eg 60 x 40cm" />
        </div>
        <div class="picture-keywords">
            <input type=text class="picture-keywords" placeholder="eg titel;kunstner;" />
        </div>
        <div class="picture-status">
            <select />
        </div>
        
        
        <a href="#edit" class="btn save" data-id="0"><span class="glyphicon glyphicon-floppy-save"></span></a>
        <a href="#main" class="btn detail nav"><span class="glyphicon glyphicon-menu-up"></span></a>
    </div>
</section>

</div>
</body>
</html>
