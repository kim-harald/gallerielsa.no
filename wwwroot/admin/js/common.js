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
    $("section.ui_page.active").fadeOut(250, function() {
        $("section.ui_page" + pageRef).fadeIn(250);
    });
    $("section.ui_page.active").removeClass("active");
    $("section.ui_page" + pageRef).addClass("active");
    
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
        method: "GET",
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

jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            var $this = $(this);
            if($this.is('input, button, textarea, select'))
              this.disabled = state;
            else
              $this.toggleClass('disabled', state);
        });
    }
});