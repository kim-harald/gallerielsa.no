
function createPictures(n) {
    var pictureTemplate = {
        id: 0,
        name: "",
        shortDescr: "",
        longDescr: "",
        path: ""
    };
    var result = [];
    for (i = 1; i < n+1; i++) {
        var p = $.parseJSON(JSON.stringify(pictureTemplate));
        p.id = i;
        p.name = "picture" + i;
        p.shortDescr = "picture" + i + ".kort beskrivelse";
        p.longDescr = "picture" + i + ".lang beskrivelse";
        p.path = "/pictures/picture" + i + ".jpg";
        result.push(p);
    }
    return result;
}

function findObject(id, objArray) {
    for (i = 0; i < objArray.length; i++) {
        if (objArray[i].id == id) return objArray[i];
    }
    return undefined;
}

function assignPicture2Exhibition(pictureId, exhibitionId, picExhArray) {
    var entry = [exhibitionId,pictureId];
    picExhArray.push(entry);
}

function getPictures(exhibitionId,picExhArray,picArray) {
    var result = [];

    if (picExhArray.length == 0 || picArray.length == 0) return result;
    
    for (var i = 0; i < picExhArray.length; i++) {
        if (picExhArray[i][0] == exhibitionId) {
            var p = findObject(picExhArray[i][1], picArray);
            result.push(p);
        }
    }
    return result;
}

function createPictureExhibition(nPic, exhibitionId, picArray) {
    var result = [];
    for (var i = 0; i < nPic; i++) {
        var last_r =-1;
        var r = -1;
        while (r == last_r) {
            r = Math.floor((Math.random() * picArray.length)); //ensure a diffent random number
        }
        var picture = picArray[r];
        assignPicture2Exhibition(picture.id, exhibitionId, result);
        last_r = r;
    }
    return result;
}

function setSection(pageRef) {
    if (pageRef === undefined) return;
    if (pageRef.indexOf("#") < 0) return;
    $("section.ui_page.active").hide();
    $("section.ui_page.active").removeClass("active");
    $("section.ui_page" + pageRef).addClass("active");
    $("section.ui_page" + pageRef).show();
}

function loadSection(pageId,id) {
	setSpinner();
    var $this = $(pageId);
    var idQuery = (id == undefined ? "" : "?id=" + id);
    var page = $this.attr("src") + idQuery;
    var href = "#" + $this.attr("id");
    $.ajax({
        url: page,
        dataType: 'html',
        success: function(xhr) {
            $(href).html(xhr);
            $("a.nav").on("click", function() {
                setSection($(this).attr("href"));
                loadContent($(this).attr("href"), $(this).attr("data-id"));
            });
            

        },
        error: function(xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function(xhr) {
        	clearSpinner();
        }
    });
}

function loadContent(src,$anchor,onComplete) {
	setSpinner();
	$.ajax({
        url: src,
        dataType: 'html',
        success: function(xhr) {
        	$anchor.html(xhr);
        	onComplete();
        },
        error: function(xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function(xhr) {
        	clearSpinner();
        }
        	
    });
}

function setSpinner() {
	$("#AjaxSpinner").addClass("loading");
}

function clearSpinner() {
	$("#AjaxSpinner").removeClass("loading");
}