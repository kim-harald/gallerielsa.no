$(function() {
	FileUploadWrapper($("#Choose"));
	$("#loader").hide();
    $("section.ui_page").hide();
    var id = getActive($(location));
    var artist = findArtist(id);
    editArtist(artist);
	$("a.btn.nav.save").disable(id==0);
	$("section#detail .ui_content,a.btn.save").attr("data-id",id);
    $("section.ui_page.active").show();

    $("a.nav").on("click", function() {
        getActive($(this));
    });

    $("section#main a.detail").on("click", function() {
    		var pictureid = $(this).attr("data-id");
        var artist = findArtist(pictureid);
        editArtist(artist);
    });

    $("a.btn.save").on("click", function() {
        var id = $(this).attr("data-id");
        var artist = findArtist(id);
        var $content = $(this).parents(".ui_content");
        artist.id = id;
        artist.firstname = $content.find("input.artist-firstname").val();
        artist.lastname = $content.find("input.artist-lastname").val();
        artist.shortDescr = $content.find("input.artist-shortdescr").val();
        artist.longDescr = $content.find("textarea.artist-longdescr").val();
        artist.profilePicturePath = $("#Path").attr("src");
        artist.createdDate = format(new Date(), "yyyy-MM-dd hh:mm:ss");
        
        saveArtist(artist);
        //updateEntry(artist);
        
    });
    
    $("a.btn.delete").on("click", function() {
    	var id = $(this).attr("data-id");
        var artist = findArtist(id);
        var $content = $(this).parents(".ui_content");
        deleteArtist(artist);
        artist.deletedDate = format(new Date(),"yyyy-MM-dd hh:mm:ss");
        saveArtist(artist);
        setSection("#main");
    });
    
    setupJodit("#Artist-longdescr",false);
    setMenuActive("artists");
});

function updateListEntry(artist) {
    var $content = $("section#main .row");
    var $element = $content.find(".artist-element[data-id='" + artist.id + "']");
    if ($element != []) {
	    $element.find(".artist-name").text(artist.firstname + " " + artist.lastname);
	    $element.attr("data-shortdescr",artist.shortDescr);
	    $element.attr("data-firstname",artist.firstname);
	    $element.attr("data-lastname",artist.lastname);
	    $element.attr("data-shortdescr",artist.shortDescr);
	    $element.attr("data-longdescr",artist.longDescr);
	    $element.attr("data-profilepicturepath",artist.profilePicturePath);
	    $element.find("img.thumbnail").attr("src",artist.profilePicturePath);
	    $element.attr("data-createddate",artist.createdDate);
	    $element.attr("data-deletedDate",artist.deletedDate);
    } else {
    	
    }
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
           updateListEntry(a);
           setSection("#main");
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
    $(".jodit_editor").html(a.longDescr);
    $("#joditArtist-longdescr").click();
    $("#Path").attr("src",a.profilePicturePath);
    $content.find("a.btn").attr("data-id", a.id);
}

function findArtist(id) {
    var $artist = $('div.artist-element[data-id="' + id + '"]');
    if ($artist.length == 0) {
        return { "id": "0",
          	"firstname": "",
            "lastname": "",
          "shortDescr": "",
          "longDescr": "",
          "profilePicturePath":"",
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
            "profilePicturePath" : $artist.attr("data-profilepicturepath"),
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
        $artist.attr("data-profilepicturepath",artist.profilePicturePath);
        $artist.attr("data-createddate", artist.createdDate);
        $artist.attr("data-deleteddate",artist.deletedDate);
    }
}
    
function deleteEntry(artist) {
	var $artist = $('div.artist-element[data-id="' + artist.id + '"]');
	$artist.remove();
}
