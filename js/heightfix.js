(function ( $ ) {
 
    $.fn.heightfix = function() {
    	var elements = $("[data-height]").toArray();

    	$.each(elements, function(i, value) {
    		imgs = $(elements[i]).find("img");
    		var orientation = $(imgs[0]).attr("data-orientation");
    		var widthheight = (orientation == 'p') ? $(imgs[0]).height() : $(imgs[0]).width();
    		var imgCount = imgs.length;
    		for (var j = 1; j <= imgCount; j++) {
    			if (orientation == 'p') {
    				$(imgs[j]).parent().height(widthheight/(imgCount-1));
    			} else {
    				$(imgs[j]).parent().width(widthheight/(imgCount-1));
    			}
    		}
    	});
    };
 
}( jQuery ));