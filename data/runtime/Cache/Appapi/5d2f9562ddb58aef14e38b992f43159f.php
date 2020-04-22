<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link type="text/css" rel="stylesheet" href="/public/home/css/layer.css"/>
    <link href='/public/appapi/css/common.css?t=1561802353' rel="stylesheet" type="text/css" >

		<title>装备中心</title>
		
		<link href='/public/appapi/css/mall.css?t=1561967793' rel="stylesheet" type="text/css" >
		<link href='/public/appapi/css/equipment.css?t=1561975646' rel="stylesheet" type="text/css" >
	</head>
<body>
    <div class="tab clearfix">
        <ul>
            <li class="on">
                靓号
                <div class="tab_line button_default"></div>
            </li>
            <li>
                坐骑
                <div class="tab_line button_default"></div>
            </li>
        </ul>
    </div>
    <div class="tab_bd liang">
        <div class="bd_content clearfix">
            <ul>
                <?php if(is_array($liang_list)): $i = 0; $__LIST__ = $liang_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="clearfix">
                    <div class="liang_id">ID:<?php echo ($v['name']); ?></div>
                    <div class="liang_coin"></div>
                    <div class="liang_buy" data-id="<?php echo ($v['id']); ?>"  data-state="<?php echo ($v['state']); ?>" >
                        <?php if($v['state'] == '1'): ?>卸载
                        <?php else: ?>
                            使用<?php endif; ?>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(empty($liang_list)): ?><div class="li_empty">
                        <p class="title">您还没有靓号哦</p>
                        <p class="des">赶快去商城挑选一个吧~</p>
                    </div><?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="tab_bd car hide">
        <div class="bd_content clearfix">
            <ul>
                <?php if(is_array($user_carlist)): $i = 0; $__LIST__ = $user_carlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                    <div class="car_img">
                        <img src="<?php echo ($v['carinfo']['thumb']); ?>">
                    </div>
                    <div class="car_title">
                        <?php echo ($v['carinfo']['name']); ?>
                    </div>
                    <div class="car_coin">
                        到期时间<br>
                        <?php echo ($v['endtime_date']); ?>
                    </div>
                    <div class="car_buy" data-id="<?php echo ($v['carid']); ?>" data-status="<?php echo ($v['status']); ?>" >
                        <?php if($v['status'] == '1'): ?>卸载
                        <?php else: ?>
                            使用<?php endif; ?>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(empty($user_carlist)): ?><div class="li_empty">
                        <p class="title">您还没有坐骑哦</p>
                        <p class="des">赶快去商城挑选一个吧~</p>
                    </div><?php endif; ?>
            </ul>
        </div>
    </div>
</body>
<script>
	var uid='<?php echo ($uid); ?>';
	var token='<?php echo ($token); ?>';
	var vip_txt='<?php echo ($vip_txt); ?>';
	var name_coin='<?php echo ($config['name_coin']); ?>';
    
    var baseSize = 100;
    function setRem () {
      var scale = document.documentElement.clientWidth / 750;
      document.documentElement.style.fontSize = (baseSize * Math.min(scale, 3)) + 'px';
    }
    setRem();
    window.onresize = function () {
      setRem();
    }
</script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/home/js/layer.js"></script>


<script src="/public/appapi/js/equipment.js"></script>
</body>
</html>