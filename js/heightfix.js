(function ( $ ) {
 
    $.fn.heightfix = function() {
    	var elements = $("[data-height]").toArray();

        $(elements).imagesLoaded(function() {
            $.each(elements, function(i, value) {
                imgs = $(elements[i]).find("img");

                // start heightfix
                var orientation = $(imgs[0]).attr("data-orientation");
                var imgHeight = $(imgs[0]).height();
                var imgCount = imgs.length;
                for (var j = 1; j <= imgCount; j++) {
                    if (orientation == 'p') {
                        $(imgs[j]).parent().parent().height(imgHeight/(imgCount-1)-imgCount-1);
                    } else {
                        $(imgs[j]).parent().parent().height(imgHeight/2);
                    }
                }

                $(elements[i]).find(".collapse").removeClass("show");
                $(elements[i]).removeAttr("data-height");
            });
        });
    };
 
}( jQuery ));