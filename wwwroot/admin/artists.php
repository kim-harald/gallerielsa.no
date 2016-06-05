<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>kunstner</title>

<?php
	include("../head.php");
	//$langCode = getDefaultLanguage();
	$artists = DAOFactory::getArtistDAO()->all();
?>
<link rel="stylesheet" href="css/styles.css">
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>
<script>
    $(function() {

        $("section.ui_page").hide();

        $("section.ui_page.active").show();

        $("a.nav").on("click", function() {
            var href = $(this).attr("href");
            setSection(href);
        });

        $("section#main a.detail").on("click", function() {
        		var pictureid = $(this).attr("data-id");
            var artist = findArtist(pictureid);
            editArtist(artist);
        });

        $("button.btn.save").on("click", function() {
            var id = $(this).attr("data-id");
            var artist = findArtist(id);
            var $content = $(this).parents(".ui_content");
            artist.id = id;
            artist.firstname = $content.find("input.artist-firstname").val();
            artist.lastname = $content.find("input.artist-lastname").val();
            artist.shortDescr = $content.find("input.artist-shortdescr").val();
            artist.longDescr = $content.find("textarea.artist-longdescr").val();
            artist.createdDate = format(new Date(), "yyyy-MM-dd hh:mm:ss");
            
            saveArtist(artist);
            updateEntry(artist);
            setSection("#main");
        });
    });

    function updateListEntry(artist) {
        var $content = $("section#main .row");
        var $element = $content.find(".artist-element[data-id='" + artist.id + "']");
        $element.find(".artist-firstname").text(artist.firstname);
        $element.find(".artist-lastname").text(artist.lastname);
        $element.attr("data-shortdescr",a.shortDescr);
    }

    function saveArtist(a) {
       var obj = { js_object: JSON.stringify(a) };

       $.ajax({
           dataType: 'json',
           url: "pages/ajax_artist.php?verb=POST",
           method: "POST",
           dataType: "json",
           data: obj,
           success: function(xhr) {
               if (a.id == 0) {
                   a.id = xhr.id;
               }
           },
           error: function(xhr) {
               alert(xhr.responseText);
           }
       });
    }

    function editArtist(a) {
        var $content = $("section#detail .ui_content");
        $content.attr("data-id", a.id);
        $content.find("input.artist-firstname").val(a.firstname);
        $content.find("input.artist-lastname").val(a.lastname);
        $content.find("input.artist-shortdescr").val(a.shortDescr);
        $content.find("textarea.artist-longdescr").val(a.longDescr);
        $content.find("button.btn.save").attr("data-id", a.id);
    }

    function findArtist(id) {
        var $artist = $('div.artist-element[data-id="' + id + '"]');
        if ($artist.length == 0) {
            return { "id": "0",
	          	"firstname": "",
	            "lastname": "",
              "shortDescr": "",
              "longDescr": "",
              "createdDate": "0000-00-00",
              "deletedDate": "0000-00-00"
            };
        }
        else {
            return { "id": id,
                "firstname": $artist.attr("data-firstname"),
                "lastname": $artist.attr("data-lastname"),
                "shortDescr": $artist.attr("data-shortdescr"),
                "longDescr": $artist.attr("data-longdescr"),
                "createdDate": $artist.attr("data-createddate"),
                "deletedDate": $artist.attr("data-deleteddate"),
                };
        }
    }
    
    function updateEntry(artist) {
        var $artist = $('div.artist-element[data-id="' + artist.id + '"]');
        if ($artist.length == 0) {
            return;
        }
        else {
            $artist.find(".artist-firstname").text(artist.firstname);
            $artist.find(".artist-lastname").text(artist.lastname);
            $artist.attr("data-shortdescr", artist.shortDescr);
            $artist.attr("data-longdescr", artist.longDescr);
            $artist.attr("data-createddate", artist.createdDate);
            $artist.attr("data-deleteddate",artist.deletedDate);
        }
    }
</script>
<?php include "header.php"?>
<div class="container-fluid">

<section class="ui_page active" id="main">
	<div class="row add">
		<div class="artist-element">
			<a href="#detail" data-id="0" class="nav btn detail">
				<img src="../images/art-icon-add.png">
			</a>
		</div>
	</div>
	<div class="row">
	<?php foreach($artists as $artist) {
	$data = 'data-id="'. $artist->id . 
			'" data-shortdescr="' . $artist->shortDescr . 
			'" data-longdescr="' .	$artist->longDescr . 
			'" data-firstname="' .	$artist->firstname . 
			'" data-lastname="' .	$artist->lastname . 
			'" data-createddate="' . $artist->createdDate . '"' .
		'" data-deleteddate="' . $artist->deletedDate . '"'
		?>
	  <div class="artist-element" <?php echo $data?>">
  		<a href="#detail" data-id="<?php echo $artist->id?>" class="nav detail">
	  		<img alt="<?php echo $artist->name; ?>" src="../images/art-icon.png">
	  		<p class="artist-name"><?php echo $artist->firstname . " " . $artist->lastname ; ?></p>
	  		<p class="artist-pictures">0</p>
  		</a>
  	 </div>
  <?php }?>
	</div>
</section>

<section class="ui_page" id="detail">
    <h1>rediger</h1>
    <div class="ui_content" data-id="1" >
        <div class="artist-firstname"><input type="text" class="artist-firstname" placeholder="fornavn" value=""/></div>
        <div class="artist-lastname"><input type="text" class="artist-lastname" placeholder="etternavn" value=""/></div>
        <div class="artist-shortdescr"><input type="text" class="artist-shortdescr" placeholder="kort beskrivesle" value=""/></div>
        <div class="artist-longdescr"><textarea class="artist-longdescr" placeholder="lang beskrivelse"></textarea></div>
        <button class="btn save" data-id="1">lagre</button>
        <a href="#main" data-id="1" class="btn nav"><span class="glyphicon glyphicon-menu-up"></span></a>
        
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
