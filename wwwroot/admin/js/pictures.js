$(function() {
      $("section.ui_page").hide();
      $("section.ui_page.active").show();
      //loadContent("pages/picture_entries.php",$("#Picture-Entries"),setEvents);
      setEvents();
      $("#imageform").hide();
      var id = getActive($(location));
      getDetails(id);
      $("a.btn.nav.save").disable(id==0);
      $("section#detail .picture,a.btn.save").attr("data-id",id);
      //$("a.btn.nav.save").disable(true);
  });

function setEvents() {
	$("a.nav").on("click", function() {
		getActive($(this));
	});

	$("a.add").on("click", function() {
		var id = $(this).attr("data-id");
		getDetails(id);
		$("section#detail .row.picture,a.btn.save").attr("data-id",id);
	});

	$("section#detail .picture a.btn.save").on("click",function() {
		savePicture();
	});

	$("a.btn.delete").on("click",function(){
		var id = $(this).attr("data-id");
		deletePicture(id);
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
		 		 $("input.picture,textarea.picture").disabled = (xhr.id == 0);
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
  var $e = $(".page-element");
  $("#Path").attr("src",p.path);
  //$("#images").val(p.path);
  $("#ThPath").text(p.thPath),
  $("#Name").val(p.name);
  $("#ShortDescr").val(p.shortDescr);
  $("#LongDescr").val(p.longDescr);
  $("#ArtistId").val(p.artistid);
  $("#Price").val(p.price);
  $("#Keywords").val(p.keywords);
  $("#Status").val(p.status);
  $("#images").attr("data-id",p.id);
  $("#pictureid").val(p.id);
  $("a.btn.delete").attr("data-id",p.id);

  if (p.id=="0") {
      $("a.btn.nav.save").disabled(true);
  }
}
          

function savePicture() {
		var picture = {
				id : $("section#detail .row.picture").attr("data-id"),
			artistid : $("#ArtistId").val(),
			name : $("#Name").val(),
			shortDescr : $("#ShortDescr").val(),
			longDescr : $("#LongDescr").val(),
			price : $("#Price").val(),
			keywords : $("#Keywords").val(),
			status : $("#Status").val(),
			path : $("#Path").attr("src"),
  thPath : $("#ThPath").text()
	};
	var obj = { js_object : JSON.stringify(picture)};
	setSpinner();
	$.ajax({
	       dataType: 'json',
	       url: "pages/ajax_picture.php?verb=post",
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