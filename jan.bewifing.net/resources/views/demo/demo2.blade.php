<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<title>万达茂大富翁</title>
<script type="text/javascript" src="js/size.js"></script>
<link rel="stylesheet" type="text/css" href="css/game.css?8">
<style type="text/css">
/* Basic */
*{padding: 0;margin: 0;word-wrap: break-word}
a{ text-decoration:none}
.cbh{ clear:both; height:0; overflow:hidden}
.fl{ float:left}
.fr{ float:right}
.block { display:block}
.none{ display:none !important}
.img-block { width:100%; display:block; margin:0 auto}
.blod { font-weight:bold}
.mc { margin:0 auto}
.tx-r { text-align:right}
.tx-c { text-align:center}
body{
    background: #000;
    color: #fff;
    font: 0.24rem/1.5 Helvetica, 'Hiragino Sans GB', 'Microsoft Yahei', '微软雅黑', Arial, sans-serif;
}
.wrap { max-width:640px;height: 100%; margin:0 auto; position: relative;overflow: hidden;}
.turnUp {
    transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
}
.turnDown {
    transform: rotate(180deg);
    -webkit-transform: rotate(180deg);
}
.turnRight {
    transform: rotate(90deg);
    -webkit-transform: rotate(90deg);
}
.btn{
    width: 3rem;
    height: .6rem;
    line-height: .6rem;
    text-align: center;
    margin: .3rem auto;
    background: green;
    font-size: .28rem;
    color: #fff;
}
.btn-box{
    position: absolute;
    z-index: 999;
    left: 1.7rem;
}
.tips{
    text-align: center;
    color: #fff;
}
.main{
  width: 34.31rem;
  height: 11.36rem;
  position: relative;
}
.animated {
    -webkit-animation-fill-mode:both;
    animation-fill-mode:both
}
#screen-w{
    width: 6.4rem;
}
</style>
</head>
<body>
<div id="screen-w"></div>
<div class="wrap">
    <div class="main">
        <div class="btn-box">
            <div class="btn" onclick="shakeDice()">摇骰子</div>
            <div class="tips"></div>
        </div>

        <div class="map">
            <img class="bg" src="images/bg1.png?1" width="100%">
        </div>

        <div class="car">
            <img id="car" class="carimg turnRight" src="images/people.png?1">
        </div>
    </div>
</div>
<audio id="foundSound" src="images/bg.mp3" loop="loop"></audio>
</body>
</html>
<script src="http://cdn.lezaigo.com/js/jquery.min.1.9.1.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){
   // console.log($(window).height());
   $(".wrap").css("height",$(window).height());

    var w = $('.bg').width();
    var sw = $('#screen-w').width();
    console.log(w-sw);
    var style = "@-webkit-keyframes fadeInDowna{0%{transform:translateX(0);}50%{transform:translateX(-"+(w-sw)+"px);}to{transform:translateX(0);}}@keyframes fadeInDowna{0%{transform:translateX(0);}50%{transform:translateX(-"+(w-sw)+"px);}to{transform:translateX(0);}}.fadeInDownA{-webkit-animation-name:fadeInDowna;animation-name:fadeInDowna;-webkit-animation-duration:8s;animation-duration:8s;animation-timing-function:linear;}";
    var newStyle = $('<style id="anim" type="text/css">' + style + "</style>");
    $("head").append(newStyle)
});


$('.main').addClass('fadeInDownA animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass('fadeInDownA animated'); 
    });


    // $('.player-top').removeClass('fadeInDownA animated').addClass('fadeInDownA animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
    //   $(this).removeClass('fadeInDownA animated'); 
    // });
audioAutoPlay('foundSound');
function audioAutoPlay(id){
    var audio = document.getElementById(id);
    document.addEventListener("WeixinJSBridgeReady", function () {
        audio.play();
    }, false);
}
var resetStep=0; // 总步数
var curPos=0; // 已走步数
var istrue=true; // 摇骰子开关
var prizeArr = ['踩到狗屎了扣100金币','遇到土匪没了1000金币','中奖彩票了加1000金币','遇到乞丐没了100金币','扶老奶奶过马路获得200金币'];

function goStep(n){
    var m = n+1;
    $(".map").addClass('map'+n+'to'+m);

    $(".car").addClass('car'+n+'to'+m); 
}
// goStep(12);

function shakeDice(){
    if (istrue) {
        istrue = false;

        if (curPos == 75) {
            $(".tips").html("游戏结束");
            return true;
        }

        var num = Math.floor(Math.random()*6+1);
        if (curPos > 69) {
            num = 75 - curPos;
        }
        $(".tips").html("走"+(num)+"步数");
        resetStep += num;
        return true;
    }
    return false;
}

function randomWord(arr){
    // 随机产生
    var pos = Math.round(Math.random() * (arr.length-1));
    return arr[pos];
}

setInterval(function(){
    if (resetStep>0) {
        if (curPos == 13) {
            $("#car").removeClass("turnRight").addClass("turnUp");
        }
        if (curPos == 21 || curPos == 49) {
            $("#car").removeClass("turnUp").addClass("turnRight");
        }
        if (curPos == 33 || curPos == 62) {
            $("#car").removeClass("turnRight").addClass("turnDown");
        }
        if (curPos == 41) {
            $("#car").removeClass("turnDown").addClass("turnUp");
        }
        if (curPos == 65) {
            $("#car").removeClass("turnDown").addClass("turnRight");
        }
        var prevPos=curPos-1;
        var nextPos=curPos+1;

        $(".map").addClass('map'+curPos+'to'+nextPos);
        if (prevPos >= 0) {
            $(".map").removeClass('map'+prevPos+'to'+curPos);
        }
        $(".car").addClass('car'+curPos+'to'+nextPos).removeClass('car'+prevPos+'to'+curPos); 
        curPos++;
        resetStep--;
        if (resetStep == 0) {
            setTimeout(function(){
                $(".tips").html(randomWord(prizeArr));
            },500);
        }
        // console.log("resetStep:"+resetStep);
        // console.log("curPos:"+curPos);
    } else {
        istrue = true;
    }
},500);
</script>