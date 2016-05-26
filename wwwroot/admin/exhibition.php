<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>utstillinger</title>
<?php 
	include '../head.php';
?>
    <script type="text/javascript" src="js/common.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<script>
$(function() {
    setSection("#main");

    setEvents();
});

function setEvents() {
	$('ul.sortable').sortable();
	
	$("a.nav").on("click", function() {
    	var id = $(this).attr("data-id");
        setSection($(this).attr("href"));
        var src = $($(this).attr("href")).attr("src");
        loadContent(src + "?id="+id, $("#detail"),setEvents);
    });

    $("a.btn.save").on("click", function() {
        var $content = $(this).parents(".row");
        var id = $(this).attr("data-id");
        var exh = { // new exhibition object
            id: id,
            name: $content.find("input.exhibition-name").val(),
            startDate: $content.find("input.exhibition-startdate").val(),
            endDate: $content.find("input.exhibition-enddate").val(),
            longDescr: $content.find("textarea.exhibition-descr").val()
        };

        var pictures = [];
        var i = 0;
        $("#SelectedPictures li").each(function() {
            pictures.push({ id: $(this).attr("data-id"), orderNo: i });
            i++;
        });
        exh.Pictures = pictures;
        saveExhibition(exh);
    });

    $("#DdArtists").on("change", function() {
        $("#AvailablePictures .select-element").hide()
        if ($(this).val() == 0) {
            $("#AvailablePictures .select-element").fadeIn(250);
        } else {
            $("#AvailablePictures .select-element[data-artistid='" + $(this).val() + "']").fadeIn(250);
        }
    });
    

    $("#AvailablePictures .select-element a").on("click", function() {
        if ($(this).parents("ul").attr("id") == "SelectedPictures") {
            $(this).find("span").removeClass("glyphicon-minus");
            $(this).find("span").addClass("glyphicon-plus");
            $("#AvailablePictures").append($(this).parent());
        } else {
            $(this).find("span").removeClass("glyphicon-plus");
            $(this).find("span").addClass("glyphicon-minus");
            $("#SelectedPictures").append($(this).parent());
        }
    });
}

function displayExhibition(exhibition) { }

function showPictures() { }
   

</script>
<div class="container-fluid site-container">

<section class="ui_page" id="main" src="" >
    <div class="add">
        <div class="page-element">
            <a href="#edit" data-id="0" class="btn nav add">
	            <img class="exhibition-element" alt="Ny utstilling" src="../images/exhibition-icon.png" />
	            <p>Ny utstilling</p>
            </a>
        </div>
    </div>
     <div class="row">
    <?php $exhibitions = DAOFactory::getExhibitionDAO()->queryAll();
    foreach($exhibitions as $exh) {
    $pictures = DAOFactory::getExhibitionDAO()->queryExhibitionPictures($exh->id);
    if (count($pictures)==0) {
    	$p = new Picture();
    } else {
    	$p = $pictures[0];
    }
    	?>
        <div class="page-element">
            <a href="#detail" data-id="<?php echo $exh->id?>" class="nav detail">
	            <img alt="" src="<?php echo $p->path?>" />
	            <p><?php echo $exh->name?></p>
	            <p><?php echo count($pictures)?></p>
            </a>
        </div>
     <?php }?>
    </div>
</section>

<section class="ui_page" id="detail" src="pages/exhibition_detail.php" >
</section>

</div>
<div id="AjaxSpinner" class=""></div>
</body>
</html>
