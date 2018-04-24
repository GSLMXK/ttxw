<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>类型管理</title>
              <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/css/school.css">
</head>

<body>
    <div class="site-block">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>栏目名称</label>
                <div class="layui-input-block numschool">
                    <input type="hidden" name="c_name" class="c_name" value="<?php echo ($data['name']); ?>">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="add_column_name layui-input" value="<?php echo ($data['name']); ?>">
                </div>
                
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span></span>备注</label>
                <div class="layui-input-block numschool">
                    <input type="hidden" class="comment" value="<?php echo ($data['comment']); ?>">
                    <input type="text" name="comment" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="add_column_comment layui-input" value="<?php echo ($data['comment']); ?>">
                </div>
            </div>
        </form>
    </div>
</body>
        <script src="/ttxw/Public/static/layui/layui.js"></script>

</html>