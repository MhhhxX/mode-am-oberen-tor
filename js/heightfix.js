(function ( $ ) {
 
    $.fn.heightfix = function() {
    	var elements = $("[data-height]").toArray();

    	$.each(elements, function(i, value) {
    		imgs = $(elements[i]).find("img");
    		var orientation = $(imgs[0]).attr("data-orientation");
    		var imgHeight = $(imgs[0]).height();
    		var imgCount = imgs.length;
    		for (var j = 1; j <= imgCount; j++) {
    			if (orientation == 'p') {
    				$(imgs[j]).parent().parent().height(imgHeight/(imgCount-1)-4);
    			} else {
    				$(imgs[j]).parent().parent().height(imgHeight/2);
    			}
    		}
            $(elements[i]).find(".collapse").removeClass("show");
            $(elements[i]).removeAttr("data-height");
    	});
    };
 
}( jQuery ));