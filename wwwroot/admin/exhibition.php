<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>utstillinger</title>
    <?php include("../head.php");
    
    ?>
    <script type="text/javascript" src="js/testTools.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<script>
    $(function() {
        $("section.ui_page").hide();
        $("section.ui_page#main").addClass("active");
        $("section.ui_page.active").show();

        initialise();

        $("a.nav").on("click", function() {
            var href = $(this).attr("href");
            set_section(href);
        });

        $("a.nav.detail").on("click", function() {
            var id = $(this).attr("data-id");
            var exh = findObject(id, Exhibitions);

            displayExhibition(exh);
        });

        $("a.btn.save").on("click",function(){
        	var id = $(this).attr("data-id");
        	
        });
    });

    function displayExhibition(exhibition) {
        var $content = $("section#detail .row");
        $content.find(".exhibition-name").text(exhibition.name);
        $content.find(".exhibition-shortdescr").text(exhibition.shortDescr);
        $content.find(".exhibition-longdescr").text(exhibition.longDescr);
        $content.find(".exhibition-startDate").text(exhibition.startDate);
        $content.find(".exhibition-endDate").text(exhibition.endDate);
        $content.find("a.btn.edit").attr("data-id", exhibition.id);

        var pictures = getPictures(exhibition.id, PictureExhibition, Pictures);
        var html = '';
        for (var i = 0; i < pictures.length; i++) {
            html += '<figure>';
            html += '<img src="'+pictures[i].path+'">';
            html += '<figcaption>' + pictures[i].name + '<figcaption>';
            html += '</figure>';
        }

        $content.find(".slideShow").html(html);


        var opts = {
            auto: {
                speed: 3500,
                pauseOnHover: true
            },
            fullScreen: false,
            swipe: true
        };
        makeBSS('.slideShow', opts);
    }

    function initialise() {
        var html = "";
        var $content = $("#main .row");

        for (var i = 0; i < Exhibitions.length; i++) {
            var exh = Exhibitions[i];
            var pictures = getPictures(Exhibitions[i].id, PictureExhibition, Pictures);
            var p = pictures[0];
            html += '<div class="exhibition-element center">' +
                        '<a href="#detail" data-id="' + exh.id + '" class="nav detail">' +
  		                    '<img alt="' + exh.name + '" src="' + p.path + '" />' +
  		                    '<p>' + exh.name + '</p>' +
  		                    '<p>' + pictures.length + '</p>'+
                         '</a>' +
                    '</div>';
        }
        $content.html(html);
    }

var Exhibitions = createExhibitions(5);
var Pictures = createPictures(100);
var PictureExhibition = createPictureExhibition(5, 1, Pictures);
PictureExhibition = PictureExhibition.concat(createPictureExhibition(7, 2, Pictures));
PictureExhibition = PictureExhibition.concat(createPictureExhibition(3, 3, Pictures));
PictureExhibition = PictureExhibition.concat(createPictureExhibition(5, 4, Pictures));
PictureExhibition = PictureExhibition.concat(createPictureExhibition(5, 5, Pictures));

</script>
<div class="container-fluid site-container">

<section class="ui_page" id="main">
    <div class="add">
        <div class="exhibition-element">
            <a href="#edit" data-id="0" class="btn nav add">
	  		    <img class="exhibition-element" alt="Ny bilde" src="../images/exhibition-icon.png" />
	  		    <p>Ny utstilling</p>
  		    </a>
        </div>
    </div>
    <div class="row">
        <div class="exhibition-element">
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
        <div class="exhibition-name">bilde titel</div>
        <div class="exhibition-shortdescr">kort beskrivelse</div>
        <div class="exhibition-longdescr">lang beskrivelse</div>
        <div class="exhibition-startDate">begynnsdato</div>
        <div class="exhibition-endDate">sluttsdato</div>
        <div class="row">
	        <a href="#edit" class="btn nav edit" data-id="0"><span class="glyphicon glyphicon-pencil"></span></a>
	        <a href="#main" class="btn main nav"><span class="glyphicon glyphicon-menu-up"></span></a>
        </div>
        <div class="slideShow bss-slides"/>
    </div>
</section>
<section class="ui_page" id="edit">
    <div class="row" data-id="0">
        <div class="dateGroup">
        	<input type="text" class="exhibition-name" placeholder="utstillingstitel"></input>
        </div>
        <div class="dateGroup">
        	<input type="text" class="exhibition-shortdescr" placeholder="kort beskrivelse"></input>
        </div>
        <div class="dateGroup">
        	<textarea class="exhibition-longdescr" placeholder="lang beskrivelse"></textarea>
        </div>
        <div class="dateGroup">
        	<label for="exhibition-startDate">startdato</label>
        	<input name="exhibition-startDate" type="date" class="exhibition-startDate" placeholder="begynnsdato"></input>
        </div>
        <div class="dateGroup">
        	<label for="exhibition-endDate">sluttdato</label>
        	<input name="exhibition-endDate" type="date" class="exhibition-endDate" placeholder="sluttsdato"></input>
        </div>
        <div>
	        <a href="#main" class="btn save nav" data-id="0"><span class="glyphicon glyphicon-floppy-save"></span></a>
	        <a href="#main" class="btn nav"><span class="glyphicon glyphicon-menu-up"></span></a>
        </div>
    </div>
</section>

<section class="ui_page" id="pictures">

</section>
</div>
</body>
</html>
