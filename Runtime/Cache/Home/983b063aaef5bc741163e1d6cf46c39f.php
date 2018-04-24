<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>修改密码</title>
	<link rel="stylesheet" href="/zscs/Public/static/css/password.css" media="all">
	          <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
</head>
<body class="beg-modifyPs-bg">
	<div class="modify-body">
		<div class="modify-box">
			<div class="modify-title">
				<h5>修改密码</h5>
			</div>
			<div class="modify-main">
				<form class="layui-form" method="post">
					<div class="layui-form-item">
						<label class="layui-form-label">账户：</label>
					<div class="layui-input-inline">
						<input type="hidden" name="user_id" value="<?php echo ($vo["user_id"]); ?>">
						<input type="text" name="account" value="<?php echo ($vo["account"]); ?>" disabled="false" class="layui-input">
					</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">原密码：</label>
					<div class="layui-input-inline">
						<input type="password" name="oldpassword" class="layui-input" placeholder="请输入原密码">
					</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">新密码：</label>
					<div class="layui-input-inline">
						<input type="password" name="newpassword" class="layui-input" placeholder="请输入新密码">
					</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">重复密码：</label>
					<div class="layui-input-inline">
						<input type="password" name="renewpassword" class="layui-input" placeholder="请再次输入新密码">
					</div>
					</div>
					<div class="layui-form-item">
    					<div class="layui-input-block">
      					<button class="layui-btn" lay-submit lay-filter="modify">保存修改</button>
      					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
    					</div>
  					</div>
				</form>
			</div>
		</div>
	</div>
	        <script src="/zscs/Public/static/layui/layui.js"></script>
	<script type="text/javascript">
		var checkurl = "<?php echo U('PersonCenter/modifyPs_handle');?>";
		var afterurl = "<?php echo U('Login/login');?>";
		rooturl = "/zscs/";
	</script>
	<script type="text/javascript" src="/zscs/Public/static/js/percenter.js"></script>
</body>
</html>