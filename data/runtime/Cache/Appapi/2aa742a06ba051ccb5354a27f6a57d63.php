<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link type="text/css" rel="stylesheet" href="/public/home/css/layer.css"/>
    <link href='/public/appapi/css/common.css?t=1561802353' rel="stylesheet" type="text/css" >

    <title>身份认证</title>
    <style type="text/css">
        *{margin: 0;padding: 0;font-family: Helvetica;}
        *{
            -webkit-tap-highlight-color:rgba(0, 0, 0, 0);  
            -moz-tap-highlight-color:rgba(0, 0, 0, 0);  
            -ms-tap-highlight-color:rgba(0, 0, 0, 0);  
            -o-tap-highlight-color:rgba(0, 0, 0, 0);  
            tap-highlight-color:rgba(0, 0, 0, 0);  
        }
        .top_img{
            margin-top:80px;
            margin-bottom:25px;
            text-align:center;
        }
        .top_img img{
            width:80px;
        }
        .title1{color: #526165;font-size: 1.1em;text-align: center;}
        .title2{color: #969696;font-size: 1.1em;text-align: center;margin-top: 15px;}
        .btn{color: #fff;width: 74%;margin:10px auto 50px;height: 46px;line-height: 46px;font-size: 1.1em;text-align: center;border-radius: 55px;}
        a:nth-of-type(3){text-decoration: none;color: #ffdd00;}
        a:nth-of-type(1){text-decoration: none;color: #939FA3;}
        .title4{width:70%;color: #969696;margin: 15% auto 0;font-weight: bold;}

    </style>

</head>
<body>
    <div class="top_img">
        <img src="/public/appapi/auth/images/auth_index.png">
    </div>
    <div class="title1">亲爱的用户</div>
    <div class="title2">收到付费礼物可领取劳务费</div>
    <div class="title2">为保证<span style="color:#ff0000">资金安全</span></div>
    <div class="title2">开播前请通过<span style="color:#ff0000">身份认证</span>绑定账户</div>
    <div class="title2">通过认证可以获得更好的体验</div>
    <div class="title4">认证即同意 <a class="color_default" href="/index.php?g=portal&m=page&a=index&id=10">主播协议</a></div>
    <a href="/index.php?g=Appapi&m=Auth&a=authstep&uid=<?php echo ($uid); ?>&token=<?php echo ($token); ?>"><div class="btn button_default">立即认证</div></a>
    
        <script src="/public/js/jquery.js"></script>
    <script src="/public/home/js/layer.js"></script>


</body>
</html>