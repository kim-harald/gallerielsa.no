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
        $("section.ui_page").hide();
        $("section.ui_page#main").addClass("active");
        $("section.ui_page.active").show();

        $("a.nav").on("click", function() {
            setSection($(this).attr("href"));
            loadContent($(this).attr("href"), $(this).attr("data-id"));
        });

        $("a.btn").on("click", function() {
            $(".slideshow").html("");
        });

        $("a.nav.detail").on("click", function() {
            var id = $(this).attr("data-id");
            var exh = findObject(id, Exhibitions);

            displayExhibition(exh);
        });

        $("a.btn.save").on("click", function() {
            var $content = $(this).parent(".row");
            var id = $(this).attr("data-id");
            var exh = { // new exhibition object
                id: id,
                name: $content.find("exhibition-name").val(),
                startDate: $content.find("exhibition-startDate").val(),
                endDate: $content.find("exhibition-endDate").val()
            };

            saveExhibition(exh);
        });
    });

    function saveExhibition(exhibition) {
    	var obj = { js_object: JSON.stringify(exhibition) };

    	   $.ajax({
    	       dataType: 'json',
    	       url: "ajax_save_exhibition.php",
    	       method: "POST",
    	       data: obj,
    	       success: function(xhr) {
    	           if (exhibition.id == 0) {
    	        	   exhibition.id = xhr.id;
    	               Exhibitions.push(exhibition);
    	               insertListEntry(exhibition);
    	           } else {
        	           var oldEntry = findObject(exhibition.id,Exhibitions);
        	           oldEntry = exhibition;
    	               updateListEntry(exhibition);
    	           }
    	       },
    	       error: function(xhr) {
    	           alert(xhr.errorText);
    	       }
    	   });
    }

    function insertListEntry(exhibition) {
    	var $content = $("#main .row");
			var exh = Exhibitions[i];
			var pictures = getPictures(Exhibitions[i].id, PictureExhibition, Pictures);
			var p = pictures[0];
			var html = '<div class="exhibition-element center" data-id="'+ exh.id +'">' +
				'<a href="#detail" data-id="' + exh.id + '" class="nav detail">' +
				'<img alt="' + exh.name + '" src="' + p.path + '" />' +
				'<p>' + exh.name + '</p>' +
				'<p>' + pictures.length + '</p>'+
				'</a>' +
				'</div>';
        $content.appendH(html);
    }

    function updateListEntry(exhibition) {
        var $content = $(".exhibition-element [data-id='"+ exhibition.id +"'");
        var pictures = getPictures(exhibition.id, PictureExhibition, Pictures);
        var p = pictures[0];
        var html = '<a href="#detail" data-id="' + exh.id + '" class="nav detail">' +
          '<img alt="' + exh.name + '" src="' + p.path + '" />' +
            '<p>' + exh.name + '</p>' +
            '<p>' + pictures.length + '</p>'+
            '</a>';
        $content.html(html);
    }

    function displayExhibition(exhibition) { }

    function showPictures() { }
   

var Exhibitions = [{"id":"1","name":"Exhibition 1","startDate":"2016-05-15","endDate":"2016-05-31"}];
var Pictures = [];
var PictureExhibition = [];
var Artists= [{"id":"1","name":"Sverre Andresen","shortDescr":"Kunster","longDescr":"lang beskrivelsevbgf","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 13:24:43","deletedDate":"0000-00-00 00:00:00"},{"id":"3","name":"H\u00e5kon Bleken","shortDescr":"..","longDescr":"..","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:23:49","deletedDate":"0000-00-00 00:00:00"},{"id":"20","name":"Pia Myrvold","shortDescr":"ei kunste","longDescr":"..","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 13:17:54","deletedDate":"0000-00-00 00:00:00"},{"id":"23","name":"Bj\u00f8rg Thorhallsdottir","shortDescr":"Kunstner","longDescr":"..","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:01:00","deletedDate":"0000-00-00 00:00:00"},{"id":"25","name":"Oddvar Thorsheim","shortDescr":"Oddvar Thorsheim","longDescr":"..","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:16:54","deletedDate":"0000-00-00 00:00:00"},{"id":"26","name":"Sidsel Gr\u00f8tter","shortDescr":"....","longDescr":"...","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:16:33","deletedDate":"0000-00-00 00:00:00"},{"id":"28","name":"Oddbj\u00f8rn St\u00f8len","shortDescr":"Oddbj\u00f8rn St\u00f8len","longDescr":"...","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:14:50","deletedDate":"0000-00-00 00:00:00"},{"id":"29","name":"Helge R\u00f8ed","shortDescr":"Helge R\u00f8ed","longDescr":"...","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:18:01","deletedDate":"0000-00-00 00:00:00"},{"id":"30","name":"Katrine Gi\u00e6ver","shortDescr":"Katrine Gi\u00e6ver","longDescr":"..","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:21:26","deletedDate":"0000-00-00 00:00:00"},{"id":"31","name":"\u00d8rnulf Opdahl","shortDescr":"..","longDescr":"..","profilePicturePath":"","jsonData":"","createdDate":"2016-05-16 14:34:28","deletedDate":"0000-00-00 00:00:00"}];

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
            <a href="#edit" data-id="<?php echo $exh->id?>" class="nav detail" data-edit="0">
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

<section class="ui_page" id="edit" src="pages/exhibition_detail.php">
</section>

</div>
</body>
</html>
