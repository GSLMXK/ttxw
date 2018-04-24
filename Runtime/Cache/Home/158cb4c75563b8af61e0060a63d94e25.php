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

					<div class="layui-input-block type_controll">
					<!-- 操作开始 -->
						<button class="layui-btn layui-btn-radius reload">
						<i class="layui-icon">&#x1002;</i>刷新</button>
						<button  type="hidden" lay-submit lay-filter="sctype" class="layui-btn layui-btn-radius type_add">
						<i class="layui-icon">&#xe608;</i>增加</button>
					</div>
					<!-- 操作结束 -->

				</div>
			</div>
		</form>
		<!-- 顶部结束 -->


		<!-- 高校信息开始 -->
		<table class="layui-table" lay-even>
		<colgroup>
    		<col >
    		<col >
   			<col width="30%">
  		</colgroup>
		  <thead>
		    <tr>
		      <th>id</th>
		      <th>名称</th>
		      <th>操作</th>
		    </tr> 
		  </thead>
		  <tbody>
		  
			  <?php if(is_array($Data)): foreach($Data as $key=>$v): ?><tr>
				      <td><?php echo ($v['type_id']); ?></td>
				      <td><?php echo ($v['name']); ?></td>
				      <td>
				      	<a class="layui-btn layui-btn-danger layui-btn-small modify_type" name="<?php echo ($v['type_id']); ?>"> 
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
	
	<script type="text/javascript">
		var type_operate = "<?php echo U('Sctype/type_operate');?>";
		var type_check = "<?php echo U('Sctype/type_check');?>";
		var type_add = "<?php echo U('Sctype/type_add');?>";
	</script>

	<script src="/zscs/Public/static/js/school.js"></script>

</body>
</html>