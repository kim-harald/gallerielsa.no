<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
	//$langCode = getDefaultLanguage();
	$artists = DAOFactory::getArtistDAO()->all();
?>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<script>
$(function() {

    $("section.ui_page").hide();

    $("section.ui_page.active").show();

    initialise();

    $("a.nav").on("click", function() {
        var href = $(this).attr("href");
        set_section(href);
    });

    $("section#main a.nav").on("click", function() {
        set_section("#detail");
        var pictureid = $(this).attr("data-id");
        var artist = find_artist(pictureid);
        display_artist(artist);
    });

    $("section#main a.add").on("click", function() {
        set_section("#edit");
        var id = $(this).attr("data-id");
        var artist = {id:0,name:"",shortDescr:"",longDescr:""};
        edit_artist(artist);
        //insert_list_entry(artist);
    });
    

    $("section#detail a.btn.edit").on("click", function() {
        set_section("#edit");
        var id = $(this).attr("data-id");
        var artist = find_artist(id);
        edit_artist(artist);
    });

    $("section#detail a.btn.del").on("click",function() {
        var id = $(this).attr("data-id");
        var artist = find_artist(id);
        remove_artist(artist);
        set_section("#main");
    });

    $("button.btn.artist-save").on("click", function() {
        var id = $(this).attr("data-id");
        var artist = find_artist(id);
        var $content = $(this).parents(".ui_content");
        artist.name = $content.find("input.artist-name").val();
        artist.shortDescr = $content.find("input.artist-shortdescr").val();
        artist.longDescr = $content.find("textarea.artist-longdescr").val();
        set_section("#detail");
        save_artist(artist);
        display_artist(artist);
        
        //initialise();
    });
});

function insert_list_entry(artist) {
	var $content = $("section#main .row:last");
	var html = '<div class="artist-element center" data-id="' + artist.id + '">' +
    '<a href="#detail" data-id="' + artist.id + '" class="nav">' +
  '<img alt="' + artist.name + '" src="../images/art-icon.png">' +
  '<p class="artist-name">' + artist.name + '</p>' +
  '<p class="artist-pictures">0</p>' +
    '</a>' +
    '</div>';
    $content.append(html);
}

function update_list_entry(artist) {
    var $content = $("section#main .row");
    var $element = $content.find(".artist-element [data-id='" + artist.id + "']");
    $element.find(".artist-name").text(artist.name);
}

function save_artist(a) {
   var obj = { js_object: JSON.stringify(a) };

   $.ajax({
       dataType: 'json',
       url: "ajax_save_artist.php",
       method: "POST",
       dataType: "json",
       data: obj,
       success: function(xhr) {
           if (a.id == 0) {
               a.id = xhr.id;
               artists.push(a);
               insert_list_entry(a);
           } else {
               var j = 0;
               for (i = 0; i < artists.length; i++) {
                   if (a.id == artists[i].id) {
                       j = i;
                       break;
                   }
               }
               artists[j] = a;
               update_list_entry(a);
           }
       },
       error: function(xhr) {
           alert(xhr.errorText);
       }
   });
}

function set_section(pageRef) {
    if (pageRef === undefined) return;
    if (pageRef.indexOf("#") < 0) return;
    $("section.ui_page.active").hide();
    $("section.ui_page.active").removeClass("active");
    $("section.ui_page" + pageRef).addClass("active");
    $("section.ui_page" + pageRef).show();
}

function display_artist(a) {
    var $content = $("section#detail .ui_content");
    $content.attr("data-id", a.id);
    $content.find(".artist-name").text(a.name);
    $content.find(".artist-shortdescr").text(a.shortDescr);
    $content.find(".artist-longdescr").text(a.longDescr);
    $content.find("a.btn.edit").attr("data-id",a.id);
    $content.find("a.btn.del").attr("data-id",a.id);
    $content.find("a.pictures").attr("href","pictures.php?id="+a.id);
}

function edit_artist(a) {
    var $content = $("section#edit.active .ui_content");
    $content.attr("data-id", a.id);
    $content.find("input.artist-name").val(a.name);
    $content.find("input.artist-shortdescr").val(a.shortDescr);
    $content.find("textarea.artist-longdescr").val(a.longDescr);
    $content.find("button.btn.artist-save").attr("data-id", a.id);
}

function remove_artist(a) {
	var obj = { js_object: JSON.stringify(a) };
	
	$.ajax({
	       dataType: 'json',
	       url: "ajax_delete_artist.php",
	       method: "POST",
	       dataType: "json",
	       data: obj,
	       success: function(xhr) {
	           if (a.id == 0) {
	               a.id = xhr.id;
	               artists.push(a);
	           } else {
	               var j = 0;
	               for (i = 0; i < artists.length; i++) {
	                   if (a.id == artists[i].id) {
	                       j = i;
	                       break;
	                   }
	               }
	               artists.splice(j,1);
	               remove_list_entry(a);
	           }
	       },
	       error: function(xhr) {
	           alert(xhr.errorText);
	       }
	   });
}

function remove_list_entry(a) {
	$("section#main .artist-element[data-id='"+a.id+"']").remove();
}

function find_artist(id) {
    for (i = 0; i < artists.length; i++) {
        if (id == artists[i].id) return artists[i];
    }
    return <?php
    	$artist = new Artist();
    	echo json_encode($artist);
    ?>
}

function initialise() {
		var html = '<div class="row">'+
		'<div class="artist-element center" data-id="0">' +
			'<a href="#edit" data-id="0" class="btn add"><img src="../images/art-icon-add.png" class="small"></span>'+
			'<p>Ny kundste</p>'+
			'</a>'+
			'</div>'+
			'</div>'; 
    
    html += '<div class="row">';

    for (i = 0; i < artists.length; i++) {
        var artist = artists[i];
        html += '<div class="artist-element center" data-id="' + artist.id + '">' +
		          '<a href="#detail" data-id="' + artist.id + '" class="nav">' +
  		      '<img alt="' + artist.name + '" src="../images/art-icon.png">' +
  		      '<p class="artist-name">' + artist.name + '</p>' +
  		      '<p class="artist-pictures">0</p>' +
		          '</a>' +
	              '</div>';
    }
    html += "</div>";
    $("section#main").html(html);
}

function format(x, y) {
    var z = {
        M: x.getMonth() + 1,
        d: x.getDate(),
        h: x.getHours(),
        m: x.getMinutes(),
        s: x.getSeconds()
    };
    y = y.replace(/(M+|d+|h+|m+|s+)/g, function(v) {
        return ((v.length > 1 ? "0" : "") + eval('z.' + v.slice(-1))).slice(-2)
    });

    return y.replace(/(y+)/g, function(v) {
        return x.getFullYear().toString().slice(-v.length)
    });
}
var artists = <?php echo json_encode($artists);?>;
</script>
<div class="container-fluid">

<section class="ui_page active" id="main">
	<div class="row">
		<div class="col-md-1">
			<a href="#detail" data-id="0" class="nav btn"><span class="glyphicon glyphicon-plus-sign"></span></a>
		</div>
	</div>
	<div class="row">
	  <div class="artist-element">
  		<a href="#detail" data-id="0" class="nav">
	  		<img alt="" src="../images/art-icon.png">
	  		<div></div>
	  		<div></div>
  		</a>
  	</div>
	</div>
</section>

<section class="ui_page" id="detail">
    <h1>kunstner</h1>
    <div class="ui_content" data-id="0">
        <h2 class="artist-name">navn</h2>
        <div class="artist-shortdescr">kort beskrivesle</div>
        <div class="artist-longdescr">lang beskrivelse</div>
        <a href="#edit" class="btn edit" data-id="0"><button><span class="glyphicon glyphicon-pencil"></span></button></a>
        <a href="#main" class="btn nav"><button><span class="glyphicon glyphicon-menu-up"></span></button></a>
        <a href="#main" class="btn del" data-id="0"><button><span class="glyphicon glyphicon-remove"></span></button></a>
        <a href="#pictures" data-id="1" class="btn pictures"><button><span class="glyphicon glyphicon-picture"></span></button></a>
    </div>
</section>

<section class="ui_page" id="edit">
    <h1>rediger</h1>
    <div class="ui_content" data-id="1" >
        <div><input placeholder="navn" class="artist-name"></div>
        <div><input class="artist-shortdescr" placeholder="kort beskrivesle"></div>
        <div>
        	<textarea class="artist-longdescr" placeholder="lang beskrivelse" ></textarea>
        </div>
        <button class="btn artist-save"data-id="1"><span class="glyphicon glyphicon-floppy-save"></span></button>
        <a href="#detail" data-id="1" class="btn nav"><button><span class="glyphicon glyphicon-menu-up"></span></button></a>
        
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

