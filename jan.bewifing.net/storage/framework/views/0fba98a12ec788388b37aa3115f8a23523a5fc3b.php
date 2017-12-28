<!DOCTYPE html><html><head><meta charset=utf-8><meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" name=viewport><meta content=yes name=apple-mobile-web-app-capable><meta content=black name=apple-mobile-web-app-status-bar-style><meta content="telephone=no" name=format-detection><title>e医</title><link href=/static\app.css rel=stylesheet></head><body><app id=app></app><script type=text/javascript src=/static\app.js></script></body></html><script>(function (doc, win) {
  var docEl = doc.documentElement,
      resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
      recalc = function () {
          var clientWidth = docEl.clientWidth;
          if (!clientWidth) return;
          if(clientWidth > 768){
            clientWidth = 768;
          }

         docEl.style.fontSize = 10 * (clientWidth / 320) + 'px';
      };
  if (!doc.addEventListener) return;
  win.addEventListener(resizeEvt, recalc, false);
  doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);</script>