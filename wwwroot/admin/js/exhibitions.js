$(function() {
		var href = $("section#main").attr("src");
		loadContent(href,$("section#main"),setEvents);
    setSection("#main");
});

function setEvents() {
	$('ul.sortable').sortable();
	
	$("a.nav").on("click", function() {
    	var id = $(this).attr("data-id");
        setSection($(this).attr("href"));
        var src = $($(this).attr("href")).attr("src");
        loadContent(src + "?id="+id, $("#detail"),setEvents);
    });

    $("a.btn.save").on("click", function() {
        var $content = $(this).parents(".row");
        var id = $(this).attr("data-id");
        var exh = { // new exhibition object
            id: id,
            name: $content.find("input.exhibition-name").val(),
            startDate: $content.find("input.exhibition-startdate").val(),
            endDate: $content.find("input.exhibition-enddate").val(),
            longDescr: $content.find("textarea.exhibition-descr").val()
        };

        var pictures = [];
        var i = 0;
        $("#SelectedPictures li").each(function() {
            pictures.push({ id: $(this).attr("data-id"), orderNo: i });
            i++;
        });
        exh.pictures = pictures;
        saveExhibition(exh);
    });

    $("a.btn.delete").on("click",function(){
        var id = $(this).attr("data-id");
        deleteExhibition(id);
    });

    $("#DdArtists").on("change", function() {
        $("#AvailablePictures .select-element").hide()
        if ($(this).val() == 0) {
            $("#AvailablePictures .select-element").fadeIn(250);
        } else {
            $("#AvailablePictures .select-element[data-artistid='" + $(this).val() + "']").fadeIn(250);
        }
    });
    

    $("#AvailablePictures .select-element a").on("click", function() {
        if ($(this).parents("ul").attr("id") == "SelectedPictures") {
            $(this).find("span").removeClass("glyphicon-minus");
            $(this).find("span").addClass("glyphicon-plus");
            $("#AvailablePictures").append($(this).parent());
        } else {
            $(this).find("span").removeClass("glyphicon-plus");
            $(this).find("span").addClass("glyphicon-minus");
            $("#SelectedPictures").append($(this).parent());
        }
    });

    $("#SelectedPictures .select-element a").on("click", function() {
        if ($(this).parents("ul").attr("id") == "SelectedPictures") {
            $(this).find("span").removeClass("glyphicon-minus");
            $(this).find("span").addClass("glyphicon-plus");
            $("#AvailablePictures").append($(this).parent());
        } else {
            $(this).find("span").removeClass("glyphicon-plus");
            $(this).find("span").addClass("glyphicon-minus");
            $("#SelectedPictures").append($(this).parent());
        }
    });
}

function saveExhibition(exhibition) { 
	var obj = { js_object : JSON.stringify(exhibition)};
	setSpinner();
	$.ajax({
	       dataType: 'json',
	       url: "pages/ajax_exhibition.php?verb=post",
	       method: "POST",
	       data: obj,
	       success: function(xhr) {
	           if (exhibition.id == 0) {
	        	   exhibition.id = xhr.id;
	           } 
	           
	       },
	       error: function(xhr) {
	           alert(JSON.stringify(xhr));
	       },
	       complete: function(xhr) {
	        	clearSpinner();
	        	loadContent("pages/exhibition_entries.php",$("section#main"),setEvents);
		        setSection("#main");
	       }
	});
}

function deleteExhibition(id) {
	setSpinner();
	$.ajax({
		dataType:'json',
		url: "pages/ajax_exhibition.php?verb=delete&id="+id,
		method:"GET",
		success:function(xhr) {
		},
		error: function(xhr) {
			alert(JSON.stringify(xhr));
		},
		complete:function(xhr) {
			clearSpinner();
			loadContent("pages/exhibition_entries.php",$("section#main"),setEvents);
			setSection("#main");
}
	});
}
