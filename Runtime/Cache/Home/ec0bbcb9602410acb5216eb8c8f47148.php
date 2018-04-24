<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>高校信息管理</title>
	          <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
	<link rel="stylesheet" type="text/css" href="/zscs/Public/static/css/school.css">

</head>
<body>
	<div class="school_content">

		<!-- 顶部开始 -->
		<form class="layui-form">
			<div class="sys_menu">
				<div class="layui-form-item">

				    <div class="layui-input-block">
				      <select name="field" class="search_list" lay-verify="">
						<option value="scid">学校代码</option>
						<option value="name">学校名称</option>
						<option value="type_id">学校类别</option>
						<option value="belong">隶属级别</option>
						<option value="nutrue">性质</option>
						<option value="level">等级</option>
						</select>
				    </div>

					<div class="layui-input-block">
		      			<input type="text" name="content" placeholder="请输入内容" autocomplete="off" required class="layui-input  content">
					</div>

					<div class="layui-input-block">
						<button class="layui-btn layui-btn-radius button_search" lay-submit lay-filter="search">
						<i class="layui-icon">&#xe615;</i>搜索</button>
						<button class="layui-btn layui-btn-radius button_all" >
						<i class="layui-icon">&#xe615;</i>显示全部</button>
					</div>

					<div class="layui-input-block controll">
					<!-- 操作开始 -->
						<button class="layui-btn layui-btn-radius reload">
						<i class="layui-icon">&#x1002;</i>刷新</button>
						<button class="layui-btn layui-btn-radius add">
						<i class="layui-icon">&#xe608;</i>增加</button>
					</div>
					<!-- 操作结束 -->

				</div>
			</div>
		</form>
		<!-- 顶部结束 -->


		<!-- 高校信息开始 -->
		<table class="layui-table" lay-even>
		  <thead>
		    <tr>
		      <th>代码</th>
		      <th>名称</th>
		      <th>类别</th>
		      <th>隶属</th>
		      <th>性质</th>
		      <th>等级</th>
		      <th>操作</th>
		    </tr> 
		  </thead>
		  <tbody>
		  <?php if(is_array($Data)): foreach($Data as $key=>$v): ?><tr>
			      <td><?php echo ($v['scid']); ?></td>
			      <td><?php echo ($v['name']); ?></td>
			      <td><?php echo ($v['type']['name']); ?></td>
			      <td><?php echo ($v['belong']); ?></td>
			      <td>
			      	<?php if(($v['nature']) == "0"): ?>公本<?php endif; ?>
			      	<?php if(($v['nature']) == "1"): ?>公专<?php endif; ?>
			      	<?php if(($v['nature']) == "2"): ?>民办<?php endif; ?> 
			      </td>
			      <td>
			      	<?php if(($v['level']) == "0"): ?>专科<?php endif; ?>
			      	<?php if(($v['level']) == "1"): ?>本科<?php endif; ?>
			      </td>
			      <td>
			      	<a class="layui-btn layui-btn-danger layui-btn-small modify" name="<?php echo ($v['scid']); ?>"> 
			      	<i class="layui-icon">&#xe642;</i>修改</a>
			      	<a class="layui-btn layui-btn-warm layui-btn-small">
			      	<i class="layui-icon">&#xe640;</i>删除</a>
			      </td>
			    </tr><?php endforeach; endif; ?>  
		  </tbody>
		</table>
		<div id="page"><?php echo ($page); ?></div>
		<!-- 高校信息结束 -->
	</div>	
	
	        <script src="/zscs/Public/static/layui/layui.js"></script>
	

	<script src="/zscs/Public/static/js/school.js"></script>

</body>
</html>