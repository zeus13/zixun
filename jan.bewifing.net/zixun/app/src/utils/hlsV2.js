var config = [
  'CuPlayerVideo Video Server 1.0',
  '',
  'CuPlayerVideo_video',
  'video/mp4',
  'video',
  'undefined',
  'probably',
  'maybe',
  '',
  '?rand=',
  '<link rel=\'stylesheet\' type=\'text/css\' href=\'',
  '\'/>',
  '<video id=\'',
  '\' controls=\'controls\' width=\'',
  '\'  height=\'460\'  poster=\'',
  '\'>',
  '<source src=\'',
  '\' type=\'video/mp4\' />',
  '</video>',
  '<video id=\'',
  '\' controls=\'controls\' width=\'100%\' height=\'260\' poster=\'',
  '\'>',
  '<source src=\'',
  '\' type=\'video/mp4\' />',
  '</video>',
  'netstreambasepath=http%3A%2F%2Flocalhost%3A81%2FHLSprovider%2Fjwplayer5%2Findex58011.html&amp;id=player&amp;hls_debug=false&amp;hls_debug2=false&amp;hls_lowbufferlength=3&amp;hls_minbufferlength=-1&amp;hls_maxbufferlength=60&amp;hls_startfromlowestlevel=true&amp;hls_seekfromlowestlevel=true&amp;hls_live_flushurlcache=false&amp;hls_live_seekdurationthreshold=60&amp;hls_seekmode=ACCURATE&amp;provider=',
  '&amp;file=',
  '&amp;qualitymonitor.pluginmode=FLASH&amp;controlbar.position=over&amp;image=',
  '',
  '<object id=\'',
  '_object\' width=\'',
  '\' height=\'',
  '\' classid=\'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\'>',
  '<param name=\'movie\' value=\'',
  '\' />',
  '<param name=\'flashvars\' value=\'',
  '\' />',
  '<param name=\'allowFullScreen\' value=\'true\' />',
  '<param name=\'allowScriptAccess\' value=\'always\' />',
  '<embed id=\'',
  '_embed\' src=\'',
  '\' type=\'application/x-shockwave-flash\' allowscriptaccess=\'always\' allowfullscreen=\'true\'  width=\'',
  '\' height=\'',
  '\' flashvars=\'',
  '\'></embed>',
  '</object>',
  'jQuery',
  '#',
  'change.ctVideoServer',
  '_embed',
  '_object',
  'function'
]
console.log(config)
var document = window.document
var c = window.navigator
var d = window.location
var e = {
  name: config[0],
  video: config[1],
  videoId: config[2],
  ishtml5: 0,
  video_type: config[3],
  isIpad: function() {
    var f = c.userAgent
    if (/iPad/i.test(f) || /iPhone/i.test(f) || /android/i.test(f) || /Windows Phone/i.test(f) || /webOS/i.test(f) || /BlackBerry/i.test(f)) {
      return true
    } else if (/palm/i.test(f) || /webos/i.test(f)) {
      return true
    } else {
      return false
    }
  },
  render: function() {
    if (this.isIpad()) {
      var f = config[1] + vCssurl + config[9] + Math.random()
      document.writeln(config[10] + f + config[11])
      var g = c.userAgent
      if (/iPad/i.test(g)) {
          video = config[12] + this.videoId + config[13] + vWidth + config[14] + vPic + config[15] + config[16] + vHLSurl + config[17] + config[18]
      } else {
          video = config[12] + this.videoId + config[20] + vPic + config[15] + config[16] + vHLSurl + config[17] + config[18]
      }
      this.ishtml5 = 1
    } else {
      var f = config[25] + vHLSset + config[26] + vHLSurl + config[27] + vPic + config[1]
      var video = config[29] + this.videoId + config[30] + vWidth + config[31] + vHeight + config[32] + config[33] + vPlayer + config[34] + config[35] + f + config[34] + config[37] + config[38] + config[39] + this.videoId + config[40] + vPlayer + config[41] + vWidth + config[31] + vHeight + config[43] + f + config[44] + config[45]
    }
    console.log(video)
    return video
  },
  init: function() {
    document.writeln(this.render())
  }
}
e.init()