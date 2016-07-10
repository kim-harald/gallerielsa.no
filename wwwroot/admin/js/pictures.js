$(function() {
      $("section.ui_page").hide();
      $("section.ui_page.active").show();
      //loadContent("pages/picture_entries.php",$("#Picture-Entries"),setEvents);
      setEvents();
      
      $("#loader").hide();
      
      var id = getActive($(location));
      getDetails(id);
      $("a.btn.nav.save").disable(id==0);
      $("section#detail .picture,a.btn.save").attr("data-id",id);
      FileUploadWrapper($("#Choose"));
      setupJodit("#LongDescr",false);
      setMenuActive("pictures");
  });

function setEvents() {
	$("a.nav").on("click", function() {
		getActive($(this));
		var id = $(this).attr("data-id");
		if  (id >0) {
			getDetails(id);
		}
	});

	$("a.add").on("click", function() {
		var id = $(this).attr("data-id");
		getDetails(id);
		$("section#detail .row.picture,a.btn.save").attr("data-id",id);
	});

	$("section#detail a.btn.save").on("click",function() {
		savePicture();
	});

	$("section#detail a.btn.delete").on("click",function(){
		var id = $(this).attr("data-id");
		deletePicture(id);
	});

	$("#BtnRotation").on("click",function(){
		var id = $("#BtnRotation").attr("data-id");
		var rotation = 90;
		$.ajax({
		dataType: 'json',
		    url: "pages/ajax_picture.php?verb=rotate&id=" + id+"&rotation="+rotation,
		    method: "GET",
		    success: function(xhr) {
		        var d = new Date();
                var n = d.getTime(); 
		        $("#Path").attr("src",xhr.path+"?ts=" + n);
                $("#ThPath").text(xhr.thPath+"?ts=" + n);
                $("img[data-id='"+id+"']").attr("src",xhr.thPath+"?ts=" + n);
                $("#Path").removeClass("landscape");
                $("#Path").removeClass("portrait");
                $("#Path").addClass(xhr.aspect);
                
		    },
		    error: function(xhr) {
		        alert(JSON.stringify(xhr));
		    },
		    complete: function(xhr) {
		        clearSpinner();
		    }
		});
	});
}

function getDetails(id) {
	setSpinner();
	if (id==0) {
		$("#CheckUpload").attr("checked","");
	$("#imageform").show();
    }
	$.ajax({
		dataType: 'json',
		url: "pages/ajax_picture.php?verb=get&id="+id,
		method: "GET",
		success: function(xhr) {
		 		 displayDetails(xhr);
		 		 $("input.picture,textarea.picture").disable = (xhr.id == "0");
	    },
	    error: function(xhr) {
	           alert(JSON.stringify(xhr));
	    },
		   	   complete: function(xhr) {
		        	clearSpinner();
	    }
	});
}

function displayDetails(p) {
	if (p.id == null) {
		
		return;
	}
  var d = new Date();
  var n = d.getTime();
  var path = p.path=="" ? "" : p.path+"?ts="+n;
  var thPath = p.thPath == "" ? "" : p.thPath+"?ts="+n
  $("#Path").attr("src",path);
  $("#Path").addClass(p.aspect);
  //$("#images").val(p.path);
  $("#ThPath").text(thPath),
  $("#Name").val(p.name);
  $("#ShortDescr").val(p.shortDescr);
  $("#LongDescr").val(p.longDescr);
  $(".jodit_editor").html(p.longDescr);
  $("#joditLongDescr").click();
  $("#ArtistId").val(p.artistid);
  $("#Price").val(p.price);
  $("#Status").val(p.status);
  $("#images").attr("data-id",p.id);
  $("#pictureid").val(p.id);
  $("section#detail .row.picture").attr("data-id",p.id);
  $("a.btn.delete").attr("data-id",p.id);
  $("a.btn.save").attr("data-id",p.id);
  $("#BtnRotation").attr("data-id",p.id);
  
  $("a.btn.nav.save").disable(p.id=="0");
}
          

function savePicture() {
		var picture = {
			id : $("#pictureid").val(),
			artistid : $("#ArtistId").val(),
			name : $("#Name").val(),
			shortDescr : $("#ShortDescr").val(),
			longDescr : $("#LongDescr").val(),
			price : $("#Price").val(),
			status : $("#Status").val(),
			path : removeTs($("#Path").attr("src")),
            thPath : removeTs($("#ThPath").text())
	};
	var obj = { js_object : JSON.stringify(picture)};
	setSpinner();
	$.ajax({
	       dataType: 'json',
	       url: "pages/ajax_picture.php?verb=post",
	       method: "POST",
	       data: obj,
	       success: function(xhr) {
//	           if (picture.id == 0) {
//	        	   picture.id = xhr.id;
//	        	   addEntry(picture.id);
//	        	   
//	           } else 
//	           {
    	           updateEntry(picture.id);
//	           }
	           $("a.btn.nav.save").disable(picture.id=="0");
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

function deletePicture(id) {
      setSpinner();
			$.ajax({
  	       dataType: 'json',
       url: "pages/ajax_picture.php?verb=delete&id="+id,
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
	  var $entry = $('.picture-element[data-id="' + id +'"');
	  $entry.remove();
}

function updateEntry(id) {
  var $entry = $('.picture-element[data-id="' + id +'"');
  if ($entry.length ==0) {
	  addEntry(id);
  }
  loadContentGet("pages/picture_entry.php",id,$entry,setEvents);
}

function addEntry(id) {
  var $entry = $('.item-container:last');
  $entry.append('<div class="item-container" data-id="'+id+'"/>');
  loadContentGet("pages/picture_entry.php",id,$entry,setEvents);
}

function loadContentGet(src,id,$anchor,onComplete) {
	  setSpinner();
	  
		$.ajax({
	        url: src,
	        data : {id:id},
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

function removeTs(s) {
    var a = s.split("?");
    if (a.length>1) return a[0]; // return first part
    return s;
}