$(function(){
	$(".textBox .button").click(function() {
		var $el, $ps, $up, totalHeight;
	    totalHeight = 0

	    $el = $(this);
	    $p = $el.parent();
	    $up = $p.parent();
	    $ps = $up.find("p:not('.read-more')");

	    // measure how tall inside should be by adding together heights of all inside paragraphs (except read-more paragraph)
	        $ps.each(function() {
	            totalHeight += $(this).outerHeight();
	        });

	    $up
		.css({
		    // Set height to prevent instant jumpdown when max height is removed
		"height": $up.height(),
		"max-height": 9999
		})
		.animate({
		    "height": totalHeight
		});
		
		        // fade out read-more
		    $p.fadeOut();
		
		    // prevent jump-down
		    return false;
	});

	$('.contactLink').on("click",function(){
		location.href = "contact.php";
	});
});

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
        