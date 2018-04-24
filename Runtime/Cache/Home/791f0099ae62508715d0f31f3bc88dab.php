<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	          <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
</head>
<body>
	<div style="margin: 15px;">
		<form class="layui-form">
			<input type="hidden" name="id" value="<?php echo ((isset($year["id"]) && ($year["id"] !== ""))?($year["id"]):''); ?>">

			<div class="layui-form-item">
				<label class="layui-form-label">年度名称</label>
				<div class="layui-input-block">
					<input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入年度" class="layui-input" style="width:80%;" value="{$.name|default=''}">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">备注</label>
				<div class="layui-input-block" >
					<input type="text" name="comment" lay-verify="comment" autocomplete="off" placeholder="请输入备注（可为空）" class="layui-input" style="width:80%;" value="<?php echo ((isset($year["comment"]) && ($year["comment"] !== ""))?($year["comment"]):''); ?>">
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit="" lay-filter="demo1">保存</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>

		</form>
	</div>
</body>
        <script src="/zscs/Public/static/layui/layui.js"></script>
<script type="text/javascript">
	var editurl = "";
	if ('<?php echo ($type); ?>' == 'update'){
		editurl = "<?php echo U('Home/CollegeMgr/updateCollege');?>";
	}else if ('<?php echo ($type); ?>' == 'add'){
		editurl = "<?php echo U('Home/CollegeMgr/addCollege');?>";
	}
	var rooturl = "/zscs/";
</script>
<script type="text/javascript" src="/zscs/Public/static/js/editCollege.js"></script>
</html>