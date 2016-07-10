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

function getActive($o) {
	var url = $o.attr('href').split("#")[1];
	var id = $o.attr('href').split("?")[1];
	if (id != undefined) {
		id = id.split("=")[1];
	}
	var section = "";
	if (url != undefined) {
		section = url.split("?")[0];
	} else {
		section = "main";
	}

	if (section != undefined) {
		setSection("#"+section);
		if (id != undefined) {
			return (id);
	    }
	}
	
	return 0;
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

var FileUploadWrapper = (function($chooseBtn) {
    $chooseBtn.on("click", function() {
        $("form input[type=file]").click();
    });
    $("form input[type=file]").on("change", function() {
    	$("form input[type=submit]").click();
    });
});

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

function setupJodit(tagName,isImage) {
	if (isImage==true) {
		new Jodit(tagName, {
			enableDragAndDropFileToEditor: true,
		    uploader: {
		        url: '../jodit/connector/uploader.php',
		        format: 'json',
		        pathVariableName: 'path',
		        filesVariableName: 'images',
		        prepareData: function (data) {
		            return data;
		        },
		        isSuccess: function (resp) {
		            return !resp.error;
		        },
		        getMsg: function (resp) {
		            return resp.msg.join !== undefined ? resp.msg.join(' ') : resp.msg;
		        },
		        process: function (resp) {
		            return {
		                files: resp[this.options.uploader.filesVariableName] || [],
		                path: resp.path,
		                baseurl: resp.baseurl,
		                error: resp.error,
		                msg: resp.msg
		            };
		        },
		        error: function (e) {
		            this.events.fire('errorPopap', [e.getMessage(), 'error', 4000]);
		        },
		        defaultHandlerSuccess: function (data, resp) {
		            var i, field = this.options.uploader.filesVariableName;
		            if (data[field] && data[field].length) {
		                for (i = 0; i < data[field].length; i += 1) {
		                    this.selection.insertImage(data.baseurl + data[field][i]);
		                }
		            }
		        },
		        defaultHandlerError: function (resp) {
		            this.events.fire('errorPopap', [this.options.uploader.getMsg(resp)]);
		        }
		    }
		    
		});
	} else {
		new Jodit(tagName, {
			buttons: ['source', 'fullsize', 'bold', 'underline', 'italic', 'strikethrough', 'font', 'fontsize', 'brush', 'eraser', 'link', 'ol', 'ul', 'list2', 'table', 'hr', 'left', 'center', 'justify', 'right', 'paragraph', 'redo', 'undo']
		});
	}
}