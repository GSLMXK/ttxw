layui.config({
    base: rooturl+'Public/static/js/'
}).use(['form', 'layedit', 'laydate','layer','upload'], function() {
    var form = layui.form(),
        $ = layui.jquery,
        layer = layui.layer,
        layedit = layui.layedit,
        laydate = layui.laydate;

    var index1;
    var index2;

     //搜索
    $(".button_search").click(function() {
        var content = $(".content").val();
        var beginDate = $('#beginDate').val();
        var endDate = $('#endDate').val();
        window.location.href = sysuInfo + "?content=" + content + "&start=" + beginDate + "&end=" + endDate;
    });
    //查询全部
    $(".button_all").click(function() {
        window.location.href = sysuInfo;
    });


    //刷新事件
    $(".reload").click(function() {
        var index = layer.load(0, { shade: false });
        window.location.reload();
    });

    //删除用户
    $(".delete").click(function(event) {
        var id = $(this).attr("name");

        layer.confirm('您确定删除该用户?', {
            btn: ['确定', '取消'] //按钮
        }, function() {

            $.post(SysUser_delete, { id: id }, function(data, textStatus, xhr) {
                if (!data.success) {
                    layer.alert(data.msg, {
                        icon: 2,
                        title: '提示',
                    });
                } else {
                    layer.alert('删除成功!', {
                        icon: 1,
                        title: '提示',
                    });
                    $(".reload").click();
                }
            });
        });
    });
    //重置用户密码
    $(".resetPwd").click(function(event) {
        var id = $(this).attr("name");

        layer.confirm('您确定重置该用户的密码吗?', {
            btn: ['确定', '取消'] //按钮
        }, function() {

            $.post(resetPwd, { id: id }, function(data, textStatus, xhr) {
                if (!data.success) {
                    layer.alert(data.msg, {
                        icon: 2,
                        title: '提示',
                    });
                } else {
                    layer.alert('操作成功!', {
                        icon: 1,
                        title: '提示',
                    });
                    $(".reload").click();
                }
            });
        });
    });
    //激活用户
    $(".motivate").click(function(event) {
        var id = $(this).attr("name");
        $.post(switchState, { id: id, state: 1 }, function(data, textStatus, xhr) {
            if (!data.success) {
                layer.alert(data.msg, {
                    icon: 2,
                    title: '提示',
                });
            } else {
                layer.alert('操作成功!', {
                    icon: 1,
                    title: '提示',
                });
                $(".reload").click();
            }
        });
    });
    //锁定用户
    $(".lock").click(function(event) {
        var id = $(this).attr("name");
        $.post(switchState, { id: id, state: 0 }, function(data, textStatus, xhr) {
            if (!data.success) {
                layer.alert(data.msg, {
                    icon: 2,
                    title: '提示',
                });
            } else {
                layer.alert('操作成功!', {
                    icon: 1,
                    title: '提示',
                });
                $(".reload").click();
            }
        });
    });
    var start = {
    istime: true, 
    format: 'YYYY-MM-DD', 
    festival: false,
      choose: function(datas){
        end.min = datas; //开始日选好后，重置结束日的最小日期
        end.start = datas //将结束日的初始值设定为开始日
      }
    };
    
    var end = {
        istime: true, 
        format: 'YYYY-MM-DD', 
        festival: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    document.getElementById('beginDate').onclick = function(){
      start.elem = this;
      laydate(start);
    }
    document.getElementById('endDate').onclick = function(){
      end.elem = this
      laydate(end);
    }

    $('#fixInfo').on('click',function () {
        var comment = $('.comment').val();
        $.ajax({
            url:updateUserUrl,
            type:"POST",
            data:{comment: comment},
            success:function(data2)
            {
                layer.msg('修改成功', {icon: 1});

            },
            error: function(){
                layer.msg('系统错误', {icon: 2});
            }
        });

    });

    $('.add').on('click',function () {
        index2 = layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['350px', '260px'], //宽高
            content: $('.window2'),
            end: function (){
                    //window.location.reload();
            }
        });
    });


    form.on('submit(submit1)', function(data){
        var account = $('#account').val();
        var name = $('#name').val();
        var comment = $('#comment').val();
        $.ajax({
            url:addSysUser,
            type:"POST",
            data:{
                account:account,
                name:name,
                comment:comment
            },
            success:function(data2)
            {
                console.log(data2);
                // console.log(data2['success']);
                if(data2.success){
                    layer.close(index2);
                    layer.msg(data2.msg, {icon: 1});
                    $(".reload").click();
                }else {
                    layer.msg(data2.msg, {icon: 2});
                }
            },
            error: function(){
                layer.msg('请求服务器超时', {icon: 2});
            }
        });
        // layer.confirm('确认修改？', {
        //     btn: ['确认','取消'] //按钮
        // }, function(){
            

        // });

        
    });

});