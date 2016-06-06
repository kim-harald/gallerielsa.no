<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
	include_once "../utilities/common.php";
	
?>
<link rel="stylesheet" href="css/styles.css">
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript" src="js/ajax_upload.js"></script>
<script type="text/javascript" src="js/common.js"></script>
 <script type="text/javascript">
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
              //var id = $(this).attr("data-id");
              //getDetails(id);
              //var pageRef = $(this).attr("href");
              //setSection(pageRef);
              //$("section#detail .row.picture,a.btn.save").attr("data-id",id);
              
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
					message : $("#Message").val(),
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

      function loadContentGet(src,id,$anchor,onComplete,isAppend=false) {
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
			
 
</script>
</head>
<body>
 
<?php include "header.php"?>
<div class="container-fluid  site-container">
<section class="ui_page active" id="main">
    <div class="add">
        <div class="page-element">
            <a href="#detail?id=0" data-id="0" class="btn nav add">
	  		    <img class="page-element" alt="Ny arrangementer" src="../images/art-icon-add.png" />
	  		    <p>Nye arrangement</p>
  		    </a>
        </div>
    </div>
    <div id="Event-Entries">
    	<?php include "pages/event_entries.php"?>
    </div>
</section>

<section class="ui_page" id="detail">
	<div class="row event" data-id="0">
		<div class="page-fields-container">		
			<div class="page-element">
				<label for="Title">titel</label><br/>
				<input id="Title" name="Title" type=text class="event title" placeholder="titel" />
			</div>
			<div class="page-element">
				<label for="Message">beskrivelse</label><br/>
				<textarea id="Message" name="Message" class="event message" placeholder="beskrivelse"></textarea>
			</div>
			<div class="page-element">
				<label for="Startdate">startdato</label><br/>
				<input id="Startdate" name="Startdate" type="date" class="event startdate" placeholder="1.7.2016"  />
			</div>
			<div class="page-element">
				<label for="Enddate">sluttdato</label><br/>
				<input id="Enddate" type=date name="Enddate" class="event enddate" placeholder="31.7.2016" />
			</div>
			<div class="btn-group">
				<a href="#main" class="btn nav save btn-default" data-id="0">lagre</span></a>
				<a href="#main" class="btn nav btn-default">avbryt</a>
				<a href="#main" class="btn nav delete btn-default">slette</span></a>
			</div>
		</div>

</div>
</section>

</div>
<div id="AjaxSpinner" class=""></div>
</body>
</html>
