var _$ = [
    "CuPlayerVideo Video Server 1.0",
    "",
    "CuPlayerVideo_video",
    "video/mp4",
    "video",
    "undefined",
    "probably",
    "maybe",
    "",
    "?rand=",
    "<link rel=\"stylesheet\" type=\"text/css\" href=\"",
    "\"/>",
    "<video id=\"",
    "\" controls=\"controls\" width=\"",
    "\"  height=\"460\"  poster=\"",
    "\">",
    "<source src=\"",
    "\" type=\"video/mp4\" />",
    "</video>",
    "<video id=\"",
    "\" controls=\"controls\" width=\"100%\" height=\"260\" poster=\"",
    "\">",
    "<source src=\"",
    "\" type=\"video/mp4\" />",
    "</video>",
    "netstreambasepath=http%3A%2F%2Flocalhost%3A81%2FHLSprovider%2Fjwplayer5%2Findex58011.html&amp;id=player&amp;hls_debug=false&amp;hls_debug2=false&amp;hls_lowbufferlength=3&amp;hls_minbufferlength=-1&amp;hls_maxbufferlength=60&amp;hls_startfromlowestlevel=true&amp;hls_seekfromlowestlevel=true&amp;hls_live_flushurlcache=false&amp;hls_live_seekdurationthreshold=60&amp;hls_seekmode=ACCURATE&amp;provider=",
    "&amp;file=",
    "&amp;qualitymonitor.pluginmode=FLASH&amp;controlbar.position=over&amp;image=",
    "",
    "<object id=\"",
    "_object\" width=\"",
    "\" height=\"",
    "\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">",
    "<param name=\"movie\" value=\"",
    "\" />",
    "<param name=\"flashvars\" value=\"",
    "\" />",
    "<param name=\"allowFullScreen\" value=\"true\" />",
    "<param name=\"allowScriptAccess\" value=\"always\" />",
    "<embed id=\"",
    "_embed\" src=\"",
    "\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\"  width=\"",
    "\" height=\"",
    "\" flashvars=\"",
    "\"></embed>",
    "</object>",
    "jQuery",
    "#",
    "change.ctVideoServer",
    "_embed",
    "_object",
    "function"
];
console.log(_$);
(function(window, b) {
    var document = window.document,
    c = window.navigator,
    d = window.location;
    var e = {
        name: _$[0],
        video: _$[1],
        videoId: _$[2],
        ishtml5: 0,
        video_type: _$[3],
        isVideoCanPlay: function(f) {
            var g = document.createElement(_$[4]);
            if (typeof(g.canPlayType) == _$[5]) {
                return false
            };
            var h = g.canPlayType(f);
            if ((h == _$[6]) || (h == _$[7])) {
                return true
            };
            return false
        },
        isIpad: function() {
            var f = c.userAgent;
            if (/iPad/i.test(f) || /iPhone/i.test(f) || /android/i.test(f) || /Windows Phone/i.test(f) || /webOS/i.test(f) || /BlackBerry/i.test(f)) {
                return true
            } else if (/palm/i.test(f) || /webos/i.test(f)) {
                return true
            } else {
                return false
            }
        },
        resize: function() {
            if (this.ishtml5) {
                var f = this.videoId;
                var g = document.getElementById(f);
                g.height = g.videoHeight;
                return true
            }
        },
        render: function() {
            if (this.isIpad()) {
                var f = _$[1] + vCssurl + _$[9] + Math.random();
                document.writeln(_$[10] + f + _$[11]);
                var g = c.userAgent;
                if (/iPad/i.test(g)) {
                    video = _$[12] + this.videoId + _$[13] + vWidth + _$[14] + vPic + _$[15] + _$[16] + vHLSurl + _$[17] + _$[18]
                } else {
                    video = _$[12] + this.videoId + _$[20] + vPic + _$[15] + _$[16] + vHLSurl + _$[17] + _$[18]
                };
                this.ishtml5 = 1
            } else {
                var f = _$[25] + vHLSset + _$[26] + vHLSurl + _$[27] + vPic + _$[1];
                video = _$[29] + this.videoId + _$[30] + vWidth + _$[31] + vHeight + _$[32] + _$[33] + vPlayer + _$[34] + _$[35] + f + _$[34] + _$[37] + _$[38] + _$[39] + this.videoId + _$[40] + vPlayer + _$[41] + vWidth + _$[31] + vHeight + _$[43] + f + _$[44] + _$[45]
            };
            console.log(video);
            return video
        },
        init: function() {
            document.writeln(this.render());
        },
        renderAt: function(f) {
            var g = f && document.getElementById(f);
            if (!g) return false;
            g.innerHTML = this.render(); (_$[46] in window) && jQuery(_$[47] + f).trigger(_$[48])
        },
        getMovie: function() {
            var f, g, h, i = [this.videoId + _$[49], this.videoId + _$[50], this.videoId];
            for (f in i) {
                h = i[f];
                g = document[h] ? document[h] : (window[h] ? window[h] : b);
                if (g) {
                    if (typeof(g.playVideo) == _$[51]) break
                }
            };
            return g
        }
    };
    window.a = e
})(window);
a.init();