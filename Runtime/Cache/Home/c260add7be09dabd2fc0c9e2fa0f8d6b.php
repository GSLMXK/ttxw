<?php if (!defined('THINK_PATH')) exit();?><!-- 年度管理 -->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>年度管理</title>
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
				<div class="layui-input-block" style="display: inline-block;margin-left: 30px; min-height: inherit; vertical-align: bottom;">
					<div class="layui-form-pane">
					<label class="layui-form-label" style="padding: 4px 15px;">时间范围</label>
					<div class="layui-input-inline">
				      <input class="layui-input" placeholder="开始日期" id="beginDate" name="beginDate" style="height:30px; line-height:30px;"  value="<?php echo ((isset($beginDate) && ($beginDate !== ""))?($beginDate):''); ?>" readonly="true">
				    </div>
				    <div class="layui-input-inline">
				      <input class="layui-input" placeholder="结束日期" id="endDate" name="endDate" style="height:30px; line-height:30px;" value="<?php echo ((isset($endDate) && ($endDate !== ""))?($endDate):''); ?>" readonly="true">
				    </div>
					</div>
				</div>
				<div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
					<input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
				</div>
				<a href="javascript:;" class="layui-btn layui-btn-small" id="search">
					<i class="layui-icon">&#xe615;</i> 搜索
				</a>
				<a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
					<i class="layui-icon">&#xe615;</i> 查看全部
				</a>
			</blockquote>
			<fieldset class="layui-elem-field">
				<legend>学院列表</legend>
				<div class="layui-field-box">
					<table class="site-table table-hover">
						<thead>
							<tr>
								<th>学院编号</th>
								<th>学院名称</th>
								<th>负责人姓名</th>
								<th>负责人电话</th>
								<th>创建时间</th>
								<th>备注</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["id"]); ?></td>
								<td><?php echo ($vo["name"]); ?></td>
								<td><?php echo ($vo["leadername"]); ?></td>
								<td><?php echo ($vo["leaderphone"]); ?></td>
								<td><?php echo ($vo["create_date"]); ?></td>
								<td><?php echo ((isset($vo["comment"]) && ($vo["comment"] !== ""))?($vo["comment"]):'无'); ?></td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>

				</div>
			</fieldset>
			<div class="admin-table-page">
				<div id="page" class="page">
				</div>
			</div>
	</div>
		<button class="layui-btn layui-btn-big layui-btn-normal" id="" onclick="main_back()">上一步</button>
		<button class="layui-btn layui-btn-big layui-btn-normal" id="" onclick="main_turn()">下一步</button>
	</body>

        <script src="/zscs/Public/static/layui/layui.js"></script>
<script type="text/javascript" src="/zscs/Public/static/js/main.js"></script>
</html>