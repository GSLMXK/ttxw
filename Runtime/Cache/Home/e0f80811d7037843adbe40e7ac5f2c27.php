<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>学院管理</title>
	          <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/zscs/Public/static/css/global.css" media="all">
	<link rel="stylesheet" href="/zscs/Public/static/css/collegeList.css" />
</head>
<body>

	<div class="admin-main">

			<blockquote class="layui-elem-quote">
				<a href="javascript:;" class="layui-btn layui-btn-small add">
					<i class="layui-icon">&#xe608;</i> 添加年度
				</a>
			</blockquote>
			<fieldset class="layui-elem-field">
				<legend>年度列表</legend>
				<div class="layui-field-box">
					<table class="site-table table-hover">
						<thead>
							<tr>
								<th>年度名称</th>
								<th>备注</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>2016</td>
								<td>2016年度</td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
								</td>
							</tr>
							<!-- <?php if(is_array($yearList)): $i = 0; $__LIST__ = $yearList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["name"]); ?></td>
								<td><?php echo ((isset($vo["comment"]) && ($vo["comment"] !== ""))?($vo["comment"]):'无'); ?></td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?> -->
						</tbody>
					</table>

				</div>
			</fieldset>
			<div class="admin-table-page">
				<div id="page" class="page">
				</div>
			</div>
	</div>
	        <script src="/zscs/Public/static/layui/layui.js"></script>
	<script type="text/javascript">
		var editurl = "<?php echo U('Home/CollegeMgr/editCollege');?>";
		var listurl = "<?php echo U('Home/CollegeMgr/collegeList');?>";
		var deleteurl = "<?php echo U('Home/CollegeMgr/deleteCollege');?>"
		var rooturl = "/zscs/";
		// var pages = <?php echo ($pages); ?>;
		// var curr = <?php echo ($requestPage); ?>;
	</script>
	<script type="text/javascript" src="/zscs/Public/static/js/collegeList.js"></script>
	
</body>
</html>