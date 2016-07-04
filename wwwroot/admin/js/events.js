$(function() {
  $("section.ui_page").hide();
  $("section.ui_page.active").show();
  //loadContent("pages/picture_entries.php",$("#Picture-Entries"),setEvents);
  setEvents();
  $("#imageform").hide();
  getActive($(location));
  //$("a.btn.nav.save").disable(true);
      
  
});
      
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
		getDetails(id);
		$("section#detail .row.picture,a.btn.save").attr("data-id",id);
    }
  }
}

function setEvents() {
  	$("a.nav").on("click", function() {
	    var pageRef = $(this).attr("href");
	    getActive($(this));
	});

  	$("a.add").on("click", function() {
	      
	});

  	$("section#detail a.btn.save").on("click",function() {
  		saveEvent();
	});

	$("a.btn.delete").on("click",function(){
		var id = $(this).attr("data-id");
		deleteEvent(id);
	});

	$("#CheckUpload").on("change",function(){
		if($(this).is(":checked")){
			$("#imageform").show();
		}
		else if($(this).is(":not(:checked)")){
			$("#imageform").hide();
        }
	});
}

function getDetails(id) {
	setSpinner();
    $.ajax({
       dataType: 'json',
       url: "pages/ajax_event.php?verb=get&id="+id,
       method: "GET",
       success: function(xhr) {
    	 		 displayDetails(xhr);
       },
       error: function(xhr) {
           alert(JSON.stringify(xhr));
       },
	   	   complete: function(xhr) {
	        	clearSpinner();
    	 }
   });
}

function displayDetails(v) {
  $("#Title").val(v.title);
  $("#Message").text(v.message);
  $(".jodit_editor").html(v.message);
  $("#joditMessage").click();
  if (v.startDate != null) {
    	$("#Startdate").val(v.startDate.substring(0,10));
  }
  if (v.endDate != null) {
    	$("#Enddate").val(v.endDate.substring(0,10));
  }
  $("a.btn.delete").attr("data-id",v.id);
  $("section#detail .row.event").attr("data-id",v.id);
}
            

function saveEvent() {
	var picture = {
		id : $("section#detail .row.event").attr("data-id"),
		title : $("#Title").val(),
		message : $(".jodit_editor").html(),
		startDate : $("#Startdate").val(),
		endDate : $("#Enddate").val()
	};
	var obj = { js_object : JSON.stringify(picture)};
	setSpinner();
	$.ajax({
		dataType: 'json',
	    url: "pages/ajax_event.php?verb=post",
	    method: "POST",
	    data: obj,
	    success: function(xhr) {
	    	if (picture.id == 0) {
	    		picture.id = xhr.id;
	        	addEntry(picture.id);
	        } else {
	        	updateEntry(picture.id);
	        }
	        setSection("#main");
	           //loadContent("pages/picture_entries.php?artistid="+picture.artistId,$("#Picture-Entries"),setEvents);
    	           
    	    },
    	error: function(xhr) {
    		alert(JSON.stringify(xhr));
    	},
    	complete: function(xhr) {
    		clearSpinner();
    	}
    });
}

function deleteEvent(id) {
	setSpinner();
	$.ajax({
		dataType: 'json',
		url: "pages/ajax_event.php?verb=delete&id="+id,
		method: "GET",
		success: function(xhr) {
	 		//loadContent("pages/picture_entries.php",$("#Picture-Entries"),setEvents);
			deleteEntry(id);
			setSection("#main");
		},
		error: function(xhr) {
			alert("Error! : "+JSON.stringify(xhr));
  	    },
  	    complete: function(xhr) {
  	    	clearSpinner();
        }
  	});
}

function deleteEntry(id) {
	var $entry = $('.event-entry[data-id="' + id +'"');
	$entry.remove();
}

function updateEntry(id) {
	var $entry = $('.event-entry[data-id="' + id +'"');
	loadContentGet("pages/event_entry.php",id,$entry,setEvents);
}

function addEntry(id) {
	var $entry = $("#Event-Entries .row");
	loadContentGet("pages/event_entry.php",id,$entry,setEvents,true);
}

function loadContentGet(src,id,$anchor,onComplete,isAppend) {
	setSpinner();
	  
	$.ajax({
        url: src,
        data : {id:id},
        method: "GET",
    dataType: 'html',
        success: function(xhr) {
	      if (isAppend) {
	    	  $anchor.append(xhr);          	      	
	      } else {
	    	  $anchor.html(xhr);
    	  }
        	
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

$(function(){
	new Jodit('#Message', {
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
});