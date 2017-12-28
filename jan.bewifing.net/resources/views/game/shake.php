<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<meta name="format-detection" content="telephone=no"/>
<meta charset="utf-8">
<link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<title>摇一摇</title>
<style type="text/css">
body{
    margin: 0;
    padding: 0;
    background: #1e0c46;
}
.container{
    width: 100%;
    position: relative;
    background: url(/include/pureyue/images/gameindex_bg.jpg) no-repeat;
    background-size: 100% 100%;

}
.row{
    width: 100%;   
    position: relative;
    top: 0;
}
.bgimage{
    position: absolute;
    top: 0;
    left: 0;
}
.bnt1{
    position: absolute;
    top: 80px;
    right: 35px;
    z-index: 1;
    animation:slideOutDown 2s infinite;
    -webkit-animation:slideOutDown 2s infinite;
    animation-direction:alternate;
    -webkit-animation-direction:alternate; 
    animation-timing-function:ease-in-out;
    -webkit-animation-timing-function:ease-in-out;
    background-image: url(/include/pureyue/images/gameindex_bnt1.png);
    background-repeat: no-repeat;
    background-position: 0 0;
    width: 110px;
    height: 110px;
}
.bnt2{
    position: absolute;
    top: 410px;
    left: 62px;
    z-index: 1;
    animation-delay:1s;
    -webkit-animation-delay:1s; /* Safari 和 Chrome */
    animation:slideOutDown 2s infinite;
    -webkit-animation:slideOutDown 2s infinite;
    animation-direction:alternate;
    -webkit-animation-direction:alternate; 
    animation-timing-function:ease-in-out;
    -webkit-animation-timing-function:ease-in-out;
    background-image: url(/include/pureyue/images/gameindex_bnt2.png);
    background-repeat: no-repeat;
    background-position: 0 0;
    width: 110px;
    height: 110px;
}

.bnt3{
    position: absolute;
    top: 720px;
    right: 88px;
    z-index: 1;
    animation-delay:2s;
    -webkit-animation-delay:2s; /* Safari 和 Chrome */
    animation:slideOutDown 2s infinite;
    -webkit-animation:slideOutDown 2s infinite;
    animation-direction:alternate;
    -webkit-animation-direction:alternate; 
    animation-timing-function:ease-in-out;
    -webkit-animation-timing-function:ease-in-out;
    background-image: url(/include/pureyue/images/gameindex_bnt3.png);
    background-repeat: no-repeat;
    background-position: 0 0;
    width: 110px;
    height: 110px;
}

.no-touch{
    background-position: 0px 0px;
    background-size: 220px 110px;
}

.touched{
    background-position: -90px 0px;
    background-size: 180px 90px;
}

.move{
    width: 30px;
    height: 30px;
    position: absolute;
    animation:moveup1 5s infinite;
    -webkit-animation:moveup1 5s infinite;
    animation-timing-function:ease-in;
    -webkit-animation-timing-function:ease-in;
    z-index: 999;
    display: none;
}


@-webkit-keyframes moveup1 {
    0% {
        -webkit-transform: translateY(600px);
    }
    100% {
        -webkit-transform: translateY(0px);
    }
}
@keyframes moveup1 {
    0% {
        transform: translateY(600px);
    }
    100% {
        transform: translateY(0px);
    }
}

@-webkit-keyframes slideOutDown {
    0% {
        -webkit-transform: translate3d(0,0,0);
        transform: translate3d(0,0,0)
    }
    100% {
        -webkit-transform: translate3d(0,-25%,0);
        transform: translate3d(0,-25%,0)
    }
}

@keyframes slideOutDown {
    0% {
        -webkit-transform: translate3d(0,0,0);
        transform: translate3d(0,0,0)
    }
    100% {
        -webkit-transform: translate3d(0,-25%,0);
        transform: translate3d(0,-25%,0)
    }
}

.slideOutDown {
    -webkit-animation-name: slideOutDown;
    animation-name: slideOutDown
}

@-webkit-keyframes flash {
  from, 50%, to {
    opacity: 1;
  }

  25%, 75% {
    opacity: 0;
  }
}

@keyframes flash {
  from, 50%, to {
    opacity: 1;
  }

  25%, 75% {
    opacity: 0;
  }
}

.flash {
  -webkit-animation-name: flash;
  animation-name: flash;
}
@-webkit-keyframes flipInX {
 
    0% {
        opacity:0;
        -webkit-transform:scale3d(.3,.3,.3);
        transform:scale3d(.3,.3,.3)
    }
    50% {
        opacity:1
    }
    }@keyframes zoomIn {
        0% {
        opacity:0;
        -webkit-transform:scale3d(.3,.3,.3);
        transform:scale3d(.3,.3,.3)
    }
    50% {
        opacity:1
    }
}

@keyframes flipInX {
    0% {
        opacity:0;
        -webkit-transform:scale3d(.3,.3,.3);
        transform:scale3d(.3,.3,.3)
    }
    50% {
        opacity:1
    }
    }@keyframes zoomIn {
        0% {
        opacity:0;
        -webkit-transform:scale3d(.3,.3,.3);
        transform:scale3d(.3,.3,.3)
    }
    50% {
        opacity:1
    }
}
.flipInX {
    -webkit-backface-visibility:visible!important;
    backface-visibility:visible!important;
}
.popo{
    width: 260px;
    margin-left: -130px;
    position: relative;
    top: 0;
    left: 50%;
}
.score_bnt{
    width: 30%;
    position: absolute;
    bottom: 50px;
    left: 35%;
}
.auto{
    margin: 0px auto;
    text-align: center;
}
.line{
    width: 80%;
    height: 220px;
    margin: 10px auto;
    background: #1e024d;
    border-radius: 5px;
}
.line ul{
    margin: 20px auto 0px;
    padding: 0;
    list-style-type: none;
    width: 240px;
}
.line ul li{
    width: 70px;
    margin: 5px;
    float: left;
}
.clearboth{
    clear: both;
}
.button{
    width: 220px;
    margin: 0 auto;
}
.bottom{
    position: absolute;
    bottom: 0;
    left: 0;
}
.startbnt{
    width: 100px;
    margin: 20px auto 0px;
}
.rightbtn{
    position: absolute;
    right: 20px;
    color: #fff;
    top:70px;
    z-index: 999
}
.rightbtn a{
    color: #fff;
    margin: 0px 5px;
    text-decoration: none;
}
.h60{
    height: 60px;
}
.h5{
    height: 5px;
}
.to-top{
    width: 50px;
    height: 79px;
    background: url(/include/pureyue/images/guide.png) no-repeat;
    background-size: 50px 79px;
    position: fixed;
    bottom: 10px;
    left: 50%;
    margin-left: -25px;
    animation:flash 5s infinite;
    -webkit-animation:flash 5s infinite;
}
</style>
</head>
<body>
<div class="container">
        <div id="bubble"></div>
        <div class="rightbtn">
        <a href="javascript:void(0)" onclick="game.ranklist()"><i class="fa fa-trophy" aria-hidden="true"></i> 排行榜</a>
        <a href="javascript:void(0)" onclick="game.rule()"><i class="fa fa-info-circle" aria-hidden="true"></i> 活动规则</a>
        </div>
    <div class="row">
        <div class="h60"></div>
        <div class="auto"><img src="/include/pureyue/images/title.png" width="80%"></div>
        <div class="line">
            <div class="h5"></div>
            <ul>
                <li class="" style="margin-top: 30px"><img src="/include/pureyue/images/popo1.png" width="60px"></li>   
                <li class=""><img src="/include/pureyue/images/popo2.png" width="60px"></li>  
                <li class="" style="margin-top: 30px"><img src="/include/pureyue/images/popo3.png" width="60px"></li>                 
            </ul>
            <div class="clearboth"></div>
            <div class="startbnt" onclick="game.lucking()"><img src="/include/pureyue/images/free.png" width="100%"></div>           
        </div>    
        
    </div>
    <div class="row" style="margin-top: 30px">
        <img class="popo" src="/include/pureyue/images/popo.png" width="100%">
        <div class="bnt1 flipInX no-touch" onclick="game.bnt1(this)"></div>
        <div class="bnt2 flipInX no-touch" onclick="game.bnt2(this)"></div>
        <div class="bnt3 flipInX no-touch" onclick="game.bnt3(this)"></div>
    </div>
    <div class="bottom"><img src="/include/pureyue/images/bottom.png" width="60%"></div>
    <div class="to-top"></div>
</div>
<audio id="btnSound" src="/game/sound/shake_sound.mp3"></audio>
</body>
</html>
<script src="http://cdn.lezaigo.com/js/jquery.min.1.9.1.js" type="text/javascript"></script>
<script type="text/javascript">

var game = {
        //拼图游戏
        bnt1 : function(obj){
            $(obj).removeClass("no-touch").addClass("touched");
            this.playBtnSound();
            
        },
        //大考场
        bnt2 : function(obj){
            $(obj).removeClass("no-touch").addClass("touched");
            this.playBtnSound();
        },
        //找不同
        bnt3 : function(obj){
            $(obj).removeClass("no-touch").addClass("touched");
            this.playBtnSound();
        },
        //排行榜
        ranklist : function(obj){
            window.location.href='http://lezaigo.com/ci/pureyue/ranklist';
        },
        //规则
        rule : function(obj){
            window.location.href='http://lezaigo.com/ci/pureyue/rule';
        },
        //抽奖页面
        lucking : function(obj){
            window.location.href='http://lezaigo.com/ci/pureyue/luckDraw';
        },
        //转发
        forward : function(){
            $.ajax({
                type: "POST",
                url: "/ci/pureyue/addforward",
                dataType: "json",
                success: function(msg){   
                        alert("分享成功");
                }
            }); 
        },
        playBtnSound : function(){
            $('#btnSound')[0].play();
        },
        bubble : function(){
            $('<div class="move"><img src="/include/pureyue/images/bubble_l.png" width="100%"></div>').appendTo("#bubble").css({ left: Math.floor(Math.random()*300), top: Math.floor(Math.random()*900) }).show().fadeOut(Math.random()*10000,function(){
                $(this).remove();
            });
        },
        getScrollTop : function(){
            var scrollTop=0;
            if(document.documentElement&&document.documentElement.scrollTop)
            {
                scrollTop=document.documentElement.scrollTop;
            }
            else if(document.body)
            {
                scrollTop=document.body.scrollTop;
            }
            return scrollTop;
        }
    }
    setInterval(function(){
        game.playBtnSound();
    },10000)
</script>