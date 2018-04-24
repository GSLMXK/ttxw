layui.config({
    base: '../../Public/static/js/'
}).use(['layer', 'laypage', 'form', 'element'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form(),
        laypage = layui.laypage,
        element = layui.element()


    form.on('submit(column)', function() {
        return false;
    });

    //刷新事件
    $(".reload").click(function() {
        var index = layer.load(0, { shade: false });
        window.location.reload();
    });

    //添加栏目
    $(".column_add").click(function() {
        layer.open({
            type: 2,
            title: '添加栏目',
            // closeBtn: 0,
            btn: ['添加', '取消'],
            shadeClose: false,
            shade: false,
            shift: 4,
            maxmin: false, //开启最大化最小化按钮
            area: ['450px', '195px'],
            content: column_operate,

            yes: function(index, layero) {
                var body = layer.getChildFrame('body', index);

                var name = body.find('.add_column_name').val();
                var comment = body.find('.add_column_comment').val();

                if (name == "") {
                    layer.msg('请输入完整信息!');
                    return false;
                }

                $.post(column_check, { name: name }, function(data, textStatus, xhr) {

                    if (!data.success) {
                        layer.alert(data.msg, {
                            icon: 2,
                            title: '提示',
                        });
                    } else {
                        $.post(column_add, { name: name, comment: comment }, function(data, textStatus, xhr) {

                            if (!data.success) {
                                layer.alert('添加失败!', {
                                    icon: 2,
                                    title: '提示',
                                });
                            } else {
                                layer.alert('添加成功!', {
                                    icon: 1,
                                    title: '提示',
                                });
                                layer.close(index);
                                $(".reload").click();
                            }

                        });
                    }
                });

            },


        });
    });


    $(".modify_column").click(function() {

        //获得当前的id信息
        var column_id = $(this).attr("name");

        layer.open({
            type: 2,
            title: '修改栏目',
            // closeBtn: 0,
            btn: ['修改', '取消'],
            shadeClose: false,
            shade: false,
            shift: 4,
            maxmin: false, //开启最大化最小化按钮
            area: ['450px', '195px'],
            content: column_operate + "?column_id=" + column_id,

            yes: function(index, layero) {
                var body = layer.getChildFrame('body', index);

                var name = body.find('.add_column_name').val();
                var comment = body.find('.add_column_comment').val();
                var c_name = body.find('.c_name').val();
                if (name == "") {
                    layer.msg('请输入完整信息!');
                    return false;
                }
                //进行修改验证
                $.post(modify_check, { name: name, c_name: c_name }, function(data, textStatus, xhr) {

                    if (!data.success) {
                        layer.alert(data.msg, {
                            icon: 2,
                            title: '提示',
                        });
                    } else {
                        //进行修改操作
                        $.post(column_modify, { column_id: column_id, name: name, comment: comment }, function(data1, textStatus1, xhr1) {

                            if (!data1.success) {
                                layer.alert('修改失败!', {
                                    icon: 2,
                                    title: '提示',
                                });
                            } else {
                                layer.alert('修改成功!', {
                                    icon: 1,
                                    title: '提示',
                                });
                                layer.close(index);
                                $(".reload").click();
                            }

                        });
                    }
                });

            },


        });

    });

    //删除栏目
    $(".delete").click(function(event) {

        var column_id = $(this).attr("name");

        layer.confirm('您确定删除该栏目?', {
            btn: ['确定', '取消'] //按钮
        }, function() {

            $.post(delete_column, { column_id: column_id }, function(data, textStatus, xhr) {
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


});
