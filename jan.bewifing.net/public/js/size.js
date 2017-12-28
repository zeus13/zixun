/**
 * @author wangjian
 * form 南宁好无聊网络科技有限公司
 *
 * time: 2017-05-06 13:27
 *
 */
(function (doc, win) {
    var docEl = doc.documentElement,
    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
    recalc = function () {
    var clientWidth = docEl.clientWidth;
    if (!clientWidth) return;
    if(clientWidth>=640){
    docEl.style.fontSize = '100px';
    }else{
    docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
    }
    };
    if (!doc.addEventListener) return;
    win.addEventListener(resizeEvt, recalc, false);
    doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);
