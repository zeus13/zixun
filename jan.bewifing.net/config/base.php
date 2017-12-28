<?php
return [
    'wechat' => [
      'app_id'  => 'wx02a844b7f3ed6af3',
      'secret'  => 'ead8190972d0e9c08a5981206d7f0610',
      'token'   => 'u3gHBgLIbFgVcG70',
      'aes_key' => 'u3gHBgLIbFgVcG70r7yipiXuxON5xDqBH3pnvYhThXy',
    ],
    'qiniu' => [
        'driver'  => 'qiniu',
        'domains' => [
            'default'   => '7xitkl.com2.z0.glb.qiniucdn.com', //你的七牛域名
            'https'     => 'boringcdn.bewifing.net',         //你的HTTPS域名
            'custom'    => 'boringcdn.bewifing.net',                //你的自定义域名
         ],
        'access_key'=> '6jc6yavreG65mZlOryRoade-T9xhtJoFTmW1dRgB',  //AccessKey
        'secret_key'=> '4AEWy69Ushl99hcXWKfco5V2pR_CwV1ro-0OViNG',  //SecretKey
        'bucket'    => 'soboring',  //Bucket名字
        'notify_url'=> '',  //持久化处理回调地址
        'chat_prefix'=> 'chat/',  //聊天图片前缀
        'avatar_prefix'=> 'wxheadimg/',  //头像图片前缀
        'images_prefix'=> 'images/',  //照片前缀
        'record_amr_prefix'=> 'record_amr/',  //录音源文件前缀
        'record_mp3_prefix'=> 'record_mp3/',  //录音源文件前缀
    ],
    'avatar_update_time' => 604800,// 头像更新间隔时间
    'user' => [
        "id" => "opxjfty_JU2nmYh3eQngBypmmSD8",
        "name" => "Vilin",
        "nickname" =>  "Vilin",
        "avatar" => "http://wx.qlogo.cn/mmhead/gwhELYibibFdSvPRmf45SR2ulLeYwRlwtO20vSQweMIu9bKvaWvtRcIw/0",
        "original" => [
          "openid" => "opxjfty_JU2nmYh3eQngBypmmSD8",
          "nickname" => "Vilin",
          "sex" => 1,
          "language" => "zh_CN",
          "city" => "南宁",
          "province" => "广西",
          "country" => "中国",
          "headimgurl" => "http://wx.qlogo.cn/mmhead/gwhELYibibFdSvPRmf45SR2ulLeYwRlwtO20vSQweMIu9bKvaWvtRcIw/0"
        ]
    ]
];
