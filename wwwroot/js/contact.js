$(function() {
    $("#SendMessage").on("click", function() {
    if (!validate($("fieldset"), $("fieldset"))) return;
        
        var msg = {
            ts: new Date(),
            name: $("#Name").val(),
            email: $("#Email").val(),
            subject: $("#Subject").val(),
            message: $("#Message").val(),
            IsNotRobot: $("#NotRobot").prop("checked"),
            IsRobot: $("#Robot").prop("checked")
        };

        if (msg.IsNotRobot && !msg.IsRobot) {
            sendMessage(msg)
            return;
        }
        alert("Pwned! Lu2r heinous spammer!");
    });
    
    $(".button-group a.nav").on("click",function(){
    	var pageRef = $(this).attr("href");
    	if (pageRef != undefined) {
    		setSection(pageRef);
    	}
    });
    setMenuActive("contact");
    google.maps.event.addDomListener(window, 'load', init_map);

});

function validate($anchor,$msgAnchor) {
    $(".errorMessage").remove();
    var msg = "";
    $anchor.find(":invalid").each(function() {
            msg += $(this).attr("data-errormsg") + "<br/>";
    });
    if (msg != "") {

        msg = '<div class="errorMessage">Må festes:-<br/>' + msg + '</div>';
        $msgAnchor.append(msg);
        return false;
    }
    return true;
}

function sendMessage(msg) {
    var obj = { js_object: JSON.stringify(msg) };
    setSpinner();
    $.ajax({
        dataType: 'json',
        url: "pages/ajax_message.php?verb=send",
        method: "POST",
        data: obj,
        success: function(xhr) {
        	 $('<div class="popup">Melding sendt</div>').bPopup({
                 autoClose: 2000 //Auto closes after 1000ms/1sec
             });
        },
        error: function(xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function(xhr) {
            clearSpinner();
            $("input").val("");
            $("textarea").val("");
        }
    });
}

function init_map() { 
	var myOptions = { 
		zoom: 12, 
		center: new google.maps.LatLng(64.4664508, 11.495252700000037), 
		mapTypeId: google.maps.MapTypeId.ROADMAP 
	}; 
	map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions); 
	marker = new google.maps.Marker({ 
		map: map, 
		position: new google.maps.LatLng(64.4664508, 11.495252700000037) 
	}); 
	infowindow = new google.maps.InfoWindow({ 
		content: '<strong>Galleria Elsa</strong><br>Kirkegata 5, Namsos, Norway<br>' 
	}); 
	google.maps.event.addListener(marker, 'click', function() { 
		infowindow.open(map, marker);
	}); infowindow.open(map, marker); 
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
