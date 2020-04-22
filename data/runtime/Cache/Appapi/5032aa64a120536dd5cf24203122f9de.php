<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link type="text/css" rel="stylesheet" href="/public/home/css/layer.css"/>
    <link href='/public/appapi/css/common.css?t=1561802353' rel="stylesheet" type="text/css" >

	<link type="text/css" rel="stylesheet" href="/public/appapi/css/family.css?t=1561712925"/>
    <title>家族中心</title>
</head>
<body class="attended">
	<div class="search">
		<div class="search_input">
			<input id="key" placeholder="搜索签约家族ID/名称">
			<span class="search_clear"></span>
		</div>
		<div class="search_btn color_default">
			搜索
		</div>
	</div>
	<div class="line10"></div>
	<div class="list_title">
		家族列表
		<div class="reload"></div>
	</div>
	<div class="user-list user-list-fillet">
		<ul>
			<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
				<a href="index.php?g=Appapi&m=Family&a=detail&familyid=<?php echo ($vo['id']); ?>&uid=<?php echo ($uid); ?>&token=<?php echo ($token); ?>">
					<div class="thumb">
						<img src="<?php echo ($vo['badge']); ?>">
					</div>
					<div class="info">
						<p class="info-title"><?php echo ($vo['name']); ?></p>
						<p class="info-des2 ellipsis"><?php echo ($vo['briefing']); ?></p>
						<p class="info-des2"><span>成员：<?php echo ($vo['count']); ?>人</span><span>ID：<?php echo ($vo['id']); ?></span></p>
					</div>
					<div class="action">
						<span class="ok" data-familyid="<?php echo ($vo['id']); ?>">申请</span>
					</div>
				</a>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>

	<script>
		var uid='<?php echo ($uid); ?>';
		var token='<?php echo ($token); ?>';
	</script>
	    <script src="/public/js/jquery.js"></script>
    <script src="/public/home/js/layer.js"></script>


	<script src="/public/appapi/js/family.js"></script>
		
</body>
</html>