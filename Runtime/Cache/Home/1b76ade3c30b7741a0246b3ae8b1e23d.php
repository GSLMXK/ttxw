<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>个人信息</title>
	          <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/zscs/Public/static/css/updateInfo.css" media="all">	
</head>
<body class="beg-info-bg">
	<div class="info-body">
		<div class="info-box">
			<div class="info-title">
				<h5>个人信息</h5>
			</div>
			<div class="info-content"> 
			<table class="layui-table">
			  <colgroup>
			    <col width="150">
			    <col width="200">
			    <col>
			  </colgroup>
			  <thead>
			  
			    <tr>
			      <th>账户</th>
			      <th>用户名称</th>
			      <th>角色</th>
			      <th>性别</th>
			      <th>部门</th>
			      <th>联系方式</th>
			      <th>操作</th>
			    </tr> 
			  </thead>
			  <?php if(is_array($userInfo)): $i = 0; $__LIST__ = $userInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>
			    <tr>
			      <td><?php echo ($vo["account"]); ?></td>
			      <td><?php echo ($vo["name"]); ?></td>
			      <td>
			      	<?php if(is_array($post_list)): foreach($post_list as $key=>$vp): if($vo.['post_id'] == $vp.['post_id']): echo ($vp["name"]); endif; endforeach; endif; ?>
			      </td>
			      <td>
			      	<?php if($vo['sex'] == 1): ?>男<?php endif; ?>
			      	<?php if($vo['sex'] == 0): ?>女<?php endif; ?>
			      </td>
			      <td><?php echo ($vo["depart"]); ?></td>
			      <td><?php echo ($vo["connect"]); ?></td>
			      <td><button class="layui-btn layui-btn-normal" id="update">编辑信息</button></td>
			    </tr>
			    </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
			  </table>
			</div>
		</div>
	</div>
	        <script src="/zscs/Public/static/layui/layui.js"></script>
	<script type="text/javascript">
		var sendurl = "<?php echo U('PersonCenter/updateInfo_handle');?>";
		var formurl = "<?php echo U('PersonCenter/update_form');?>";
		rooturl = "/zscs/";		
	</script>
	<script type="text/javascript" src="/zscs/Public/static/js/percenter.js"></script>
</body>
</html>