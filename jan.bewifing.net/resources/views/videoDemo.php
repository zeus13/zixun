<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
    <meta name="renderer" content="webkit">
    <title>测试页面</title>
    <style>
        body{margin:0;text-align: center;}
        video{max-width: 1200px;width: 100%;}
    </style>
</head>
<script>
</script>
<body>

<video id="myPlayer" poster="" controls playsInline webkit-playsinline autoplay>
    <source src="ezopen://open.ys7.com/106330831/1.hd.live" type="application/x-mpegURL" />
</video>

<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://open.ys7.com/sdk/js/1.1/ezuikit.js"></script>
<script>
$(function(){ 

    $(".button1").click(function (event) {
        $.ajax({
            type: "post",
            url: "/api/getVideoList",
            dataType: "json",
            data: {ordersn: 'g2017121557575450'},
            beforeSend: function(){},
            success: function(data){
                if (data.code === 200) {
                    console.log(data.msg);
                    WXPayment(data.obj.config);
                }
                console.log(data.msg);
            },
            error: function(){}
        });
    });
});
    var player = new EZUIPlayer('myPlayer');
    player.on('error', function(){
        console.log('error');
    });
    player.on('play', function(){
        console.log('play');
    });
    player.on('pause', function(){
        console.log('pause');
    });

</script>
</body>
</html>