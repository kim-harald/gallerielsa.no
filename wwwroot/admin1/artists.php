<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
	//$langCode = getDefaultLanguage();
	$artists = DAOFactory::getArtistDAO()->all();
?>

</head>
<body>
<script>
    $(function() {

        initialise();

        $("a").on("click", function() {
            var pageRef = $(this).attr("href");
            if (pageRef.indexOf("#") < 0) return;
            $("section.ui_page.active").hide();
            $("section.ui_page.active").removeClass("active");
            $("section.ui_page" + pageRef).addClass("active");
            $("section.ui_page" + pageRef).show();
        });

        $("section#main a.nav").on("click", function() {
            var pictureid = $(this).data("id");
            var src = "pages/artist_detail.php?artistid=" + pictureid;
            $.get(src, "html")
                .done(function(html) {
                    var $pageContent = $("#detail");
                    $pageContent.html(html);
                })
                .fail(function(err) {
                    alert(err);
                });
        });
    });

    function initialise() {
        $("section.ui_page").hide();
        $("section.ui_page.active").show();
    }
</script>
<div class="container-fluid">
<section class="ui_page active" id="main">
	<div class="row">
		<div class="col-md-1">
			<a href="#detail" data-id="0" class="nav btn"><span class="glyphicon glyphicon-plus-sign"></span></a>
		</div>
	</div>
	<div class="row">
		<?php foreach ($artists as $artist) {?>
	  <div class="col-md-1">
	  	<div>
	  		<a href="#detail" data-id="<?php echo $artist->id;?>" class="nav"><?php echo $artist->name;?></a>
	  	</div>
  	</div>
	  <?php }?>
	</div>
</section>

<section class="ui_page" id="detail">
    <h1>kunster</h1>
    <div class="ui_content" data-id="1">
        <p>navn</p>
        <p>kort beskrivesle</p>
        <p>lang beskrivelse</p>
        <a href="#edit" class="btn"><span class="glyphicon glyphicon-arrow-r"></span></a>
        <a href="#main" class="btn"><span class="glyphicon glyphicon-back"></span></a>
    </div>
</section>

<section class="ui_page" id="edit">
    <h1>rediger</h1>
    <div class="ui_content" data-id="1" >
         <input type="text" placeholder="navn">
        <input placeholder="kort beskrivelse">
        <textarea placeholder="lang beskrivelser"></textarea>
        <button data-icon="check" class="artist-save" data-inline="true" data-artistid="1"></button>
        <a href="#detail" data-id="1"><span class="glyphicon glyphicon-back"></a>
        <a href="#pictures" data-id="1"><button data-icon="grid" data-inline="true"></button></a>
    </div>
</section>

<section class="ui_page" id="pictures">
    <h1>bilder</h1>
    <div class="ui_content" data-id="1" >
        <img src="picture1.jpg" class="picture-thumbnail" />
        <img src="picture2.jpg" class="picture-thumbnail" />
        <img src="picture3.jpg" class="picture-thumbnail" />
        <img src="picture4.jpg" class="picture-thumbnail" />
        <a href="#main">back</a>    
    </div>
</section>
</div>
</body>
</html>
