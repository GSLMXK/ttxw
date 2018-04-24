layui.config({
	base: '../../Public/static/js/'
}).use(['layer', 'form','validator'], function() {
	var layer = layui.layer,
	$ = layui.jquery,
	form = layui.form(),
	validator = layui.validator;
	var code_img = $('#code-box').find('img');
	var verifyimg = code_img.attr("src"); 
	form.on('submit(login)',function(rec){
		if(!validator.IsNotEmpty(rec.field['account']) || !validator.IsNotEmpty(rec.field['password'])){
			layer.msg('账号或密码不能为空!');
		}else if($.trim(rec.field['password']).length<6 || $.trim(rec.field['password']).length>16){
			layer.msg('密码的长度为6-16位');
			$('input[name=password]').focus();
		}else if(!validator.IsNotEmpty(rec.field['verify_code'])){
			layer.msg('请填写验证码!');
			$('input[name=verify_code]').focus();
		}else{
			//ajax验证验证码
		  	$.post(checkurl,{code:rec.field['verify_code']},function(data, textStatus, xhr){
		  		if(!data.success){
		  			layer.alert('验证码错误!', { 
		  			   icon: 2,
		  			   title:'提示',
		  			});
		  			if(verifyimg.indexOf('?')>0){  
				        code_img.attr("src", verifyimg+'&random='+Math.random());  
				    }else{  
				        code_img.attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
				    }  
		  		}else{
		  			$.post(loginurl, {account:rec.field['account'],password:rec.field['password']}, function(data, textStatus, xhr) {
		  				if(!data.success){
		  					layer.alert('账号不存在或账号密码填写错误', { 
		  					   icon: 2,
		  					   title:'提示',
		  					});
		  				}else{
		  					var index = layer.load(0, {shade: false}); 
		  					window.location.href=loginrec;
		  					layer.close(index);
		  				}
		  			});
		  		}
		  	});

		}
	   return false;
	});

	//随机置换验证码
	 
	code_img.attr('title', '点击刷新');  
	code_img.click(function(){  
	    if(verifyimg.indexOf('?')>0){  
	        $(this).attr("src", verifyimg+'&random='+Math.random());  
	    }else{  
	        $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
	    }  
	});  
});
