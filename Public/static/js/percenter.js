layui.config({
	base: rooturl+'Public/static/js/'
}).use(['layer', 'form','validator'], function() {
	var layer = layui.layer,
	$ = layui.jquery,
	form = layui.form(),
	validator = layui.validator;
	form.on('submit(modify)',function(rec){
		if(!validator.IsNotEmpty(rec.field['oldpassword'])) {
			layer.msg('请填写原密码！');
		}else if(!validator.IsNotEmpty(rec.field['newpassword'])) {
			layer.msg('请填写新密码！');
		}else if(!validator.IsNotEmpty(rec.field['renewpassword'])) {
			layer.msg('请重复填写新密码！');
		}else if($.trim(rec.field['newpassword']).length<6 || $.trim(rec.field['password']).length>16) {
			layer.msg('密码长度为6-16位');
			$('input[name=newpassword]').focus();
		}else if($('input[name=newpassword]').val() != $('input[name=renewpassword]').val()) {
			layer.msg('两次输入密码不一致！');
			$('input[name=newpassword]').focus();
		}else {
			$.post(checkurl,{user_id:rec.field['user_id'], oldpassword:rec.field['oldpassword'], newpassword:rec.field['newpassword']}, function(data){
				if(!data.success) {
					layer.alert('原密码错误！', {
						icon: 2,
						title: '提示',
					});
				}else{
					layer.alert('修改成功！', {
						icon: 1,
					}, function() {
						top.location.href = afterurl;
						layer.close(index);	
					});				
				}
			});
		}
		return false;
	});
	/*点击编辑个人信息后的触发事件*/
	$("#update").click(function() {
		layer.open({
			title: '编辑个人信息',
			type: 2,
			shadeClose: true,
			shade: 0.8,
			fix:true,
			maxmin: true,
			area: ['680px', '500px'],
			content: formurl,
			scrollbar: false,
		});
	});
	form.render();
	form.on('submit(update)', function(rec){
		$.post(form_sendurl, {user_id:rec.field['user_id'],name:rec.field['name'],post:rec.field['post'],sex:rec.field['sex'],depart:rec.field['depart'],connect:rec.field['connect']}, function(data){
			if(data.success) {
				
				layer.alert('信息更新成功！',{
					icon: 1,
					ttitle: '提示',
				},function() {
					parent.location.href = after_Infourl;
					layer.close(index);
				});
			}
		});
		return false;
	});
	

});