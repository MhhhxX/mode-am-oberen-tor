(function($) {
	$.fn.animateRotate = function(startangle, angle, duration, easing, complete) {
		var args = $.speed(duration, easing, complete);
		var step = args.step;
		return this.each(function(i, e) {
		    args.complete = $.proxy(args.complete, e);
		    args.step = function(now) {
		    	$.style(e, 'transform', 'rotate(' + now + 'deg)');
		    	if (step) return step.apply(e, arguments);
		    };

			$({deg: startangle}).animate({deg: angle}, args);
		});
	};
}(jQuery));