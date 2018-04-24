<?php if (!defined('THINK_PATH')) exit();?><!-- 年度管理 -->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>年度管理</title>
	          <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
</head>
	<body>
	<div class="admin-main">

			<blockquote class="layui-elem-quote">
				
				<form class="layui-form" action="">
					<div class="layui-form-item">
						<a href="javascript:;" class="layui-btn layui-btn-small add">
							<i class="layui-icon">&#xe608;</i> 添加年度
						</a>
						<a href="javascript:;" class="layui-btn layui-btn-small manage">
							<i class="layui-icon">&#xe622;</i> 年度管理
						</a>
					</div>
					
				  <div class="layui-form-item">
				    <label class="layui-form-label">请选择年度</label>
				    <div class="layui-input-block">
				      <select name="city" lay-verify="required">
				        <option value=""></option>
				        <option value="0">2018</option>
				        <option value="1">2017</option>
				        <option value="2">2016</option>
				        <option value="3">2015</option>
				        <option value="4">2014</option>
				      </select>
				    </div>
				  </div>
				</form>
				 
			</blockquote>
			<div class="admin-table-page">
				<div id="page" class="page">
				</div>
			</div>
	</div>
	<div align="right" style="margin-right: 20px">
		<button class="layui-btn layui-btn-big layui-btn-normal" id="" onclick="main_back()">上一步</button>
		<button class="layui-btn layui-btn-big layui-btn-normal" id="" onclick="main_turn()">下一步</button>
	</div>
	</body>

        <script src="/zscs/Public/static/layui/layui.js"></script>
<script type="text/javascript">
	var editurl = "<?php echo U('Year/Year_editYear');?>";
	var manager_url = "<?php echo U('Year/Year_manage');?>";
</script>
<script type="text/javascript" src="/zscs/Public/static/js/main.js"></script>
<script type="text/javascript" src="/zscs/Public/static/js/year.js"></script>
</html>