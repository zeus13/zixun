(function (doc, win) {
	var docEl = doc.documentElement,
	    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
	    recalc = function () {
	        var clientWidth = docEl.clientWidth;
	      	if (!clientWidth) return;
	      	if(clientWidth > 400){
	      		clientWidth = 400;
	      	}

	     	 docEl.style.fontSize = 10 * (clientWidth / 320) + 'px';
	    };
	if (!doc.addEventListener) return;
	win.addEventListener(resizeEvt, recalc, false);
	doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);