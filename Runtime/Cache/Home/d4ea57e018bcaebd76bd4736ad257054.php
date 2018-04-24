<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>头条新闻管理系统</title>
		          <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/layui/css/layui.css">
		<link rel="stylesheet" href="/ttxw/Public/static/css/global.css" media="all">
		       <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_6goayid476869a4i.css" rel="stylesheet">

	</head>
	<style type="text/css">
		.layui-nav-tree .layui-nav-child a {
		    margin-left: 10px;
		}
	</style>
	<body>
		<div class="layui-layout layui-layout-admin">
			<div class="layui-header header header-demo">
				<div class="layui-main">
					<div class="admin-login-box">
						<a class="logo" style="left: 0;">
							<span style="font-size: 18px;">头条新闻管理系统</span>
						</a>
						<div class="admin-side-toggle">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</div>
					</div>
					<ul class="layui-nav admin-header-item">
						<li class="layui-nav-item">
							<a href="javascript:;">清除缓存</a>
						</li>
						<li class="layui-nav-item">
							<a href="javascript:;" class="admin-header-user">
								<!-- <img src="/ttxw/Public/<?php echo ($data["img"]); ?>" /> -->
								<img id="LAY_demo_upload" src="<?php if(($data["photo"]) != ""): echo ($data["photo"]); else: ?>/ttxw/Public/static/img/default.jpg<?php endif; ?> "/>
								<span><?php echo ($data["name"]); ?></span>
							</a>
							<dl class="layui-nav-child">
								<dd>
									<a href="javascript:;"><i class="fa fa-user-circle" aria-hidden="true"></i> 个人信息</a>
								</dd>
								<dd>
									<a href="javascript:;"><i class="fa fa-gear" aria-hidden="true"></i> 设置</a>
								</dd>
								<dd>
									<a href="/ttxw/index.php/Home/Login/Login_logout"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
								</dd>
							</dl>
						</li>
					</ul>
					<ul class="layui-nav admin-header-item-mobile">
						<li class="layui-nav-item">
							<a href="login.html"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="layui-side layui-bg-black" id="admin-side">
				<div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
			</div>

			
			<div class="layui-body" style="bottom: 0;border-left: solid 2px #1AA094;" id="admin-body">
				<div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
					<ul class="layui-tab-title">
						<li class="layui-this">
							<i class="fa fa-dashboard" aria-hidden="true"></i>
							<cite>控制面板</cite>
						</li>
					</ul>
					<div class="layui-tab-content" style="min-height: 150px; padding: 5px 0 0 0;">
						<div class="layui-tab-item layui-show">
							<iframe src="/ttxw/index.php/Home/Index/main"></iframe>
						</div>
					</div>
				</div>
			</div>
			<!-- 底部文件 -->
			<div class="layui-footer footer footer-demo" id="admin-footer">
				<div class="layui-main">
					<p>2017 &copy;
						<a>成都信息工程大学</a>
					</p>
				</div>
			</div>
			<div class="site-tree-mobile layui-hide">
				<i class="layui-icon">&#xe602;</i>
			</div>
			<div class="site-mobile-shade"></div>
			        <script src="/ttxw/Public/static/layui/layui.js"></script>
			<script type="text/javascript">
				menudataurl = "<?php echo U('Home/Index/GetMenulist');?>";
				site = "/ttxw/index.php/";
				rooturl = "/ttxw/";
			</script>
			        <script src="/ttxw/Public/static/js/index.js"></script>
		</div>
	</body>

</html>