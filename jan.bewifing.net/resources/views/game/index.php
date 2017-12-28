<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>传送带小游戏</title>
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="full-screen" content="true"/>
    <meta name="screen-orientation" content="portrait"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>
    <style>
        html, body {
            -ms-touch-action: none;
            background: #ffffff;
            color: #000;
            padding: 0;
            border: 0;
            margin: 0;
            height: 100%;
        }
    </style>

    <!--这个标签为通过egret提供的第三方库的方式生成的 javascript 文件。删除 modules_files 标签后，库文件加载列表将不会变化，请谨慎操作！-->
    <!--modules_files_start-->
    <script egret="lib" src="game/libs/modules/egret/egret.min.js"></script>
    <script egret="lib" src="game/libs/modules/egret/egret.web.min.js"></script>
    <script egret="lib" src="game/libs/modules/eui/eui.min.js"></script>
    <script egret="lib" src="game/libs/modules/res/res.min.js"></script>
    <script egret="lib" src="game/libs/modules/tween/tween.min.js"></script>
    <script egret="lib" src="game/libs/modules/Game/Game.min.js"></script>
    <script egret="lib" src="game/libs/modules/Game/Game.web.min.js"></script>
    <!--modules_files_end-->

    <!--这个标签为不通过egret提供的第三方库的方式使用的 javascript 文件，请将这些文件放在libs下，但不要放在modules下面。-->
    <!--other_libs_files_start-->
    <!--other_libs_files_end-->

    <!--这个标签会被替换为项目中所有的 javascript 文件。删除 game_files 标签后，项目文件加载列表将不会变化，请谨慎操作！-->
    <!--game_files_start-->
    <script src="game/main.min.js"></script>
    <!--game_files_end-->
</head>
<body>
    <div style="margin: auto;width: 100%;height: 100%;" class="egret-player"
         data-entry-class="Main"
         data-orientation="auto"
         data-scale-mode="noBorder"
         data-frame-rate="30"
         data-content-width="600"
         data-content-height="950"
         data-show-paint-rect="false"
         data-multi-fingered="2"
         data-show-fps="false" data-show-log="false"
         data-show-fps-style="x:0,y:0,size:12,textColor:0xffffff,bgAlpha:0.9">
    </div>
    <script>
        /**
         * {
         * "renderMode":, //引擎渲染模式，"canvas" 或者 "webgl"
         * "audioType": "" //使用的音频类型，0:默认，1:qq audio，2:web audio，3:audio
         * }
         **/
        egret.runEgret({renderMode:"webgl", audioType:0});
    </script>
</body>
</html>
