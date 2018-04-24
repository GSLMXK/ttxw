<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>类型管理</title>
              <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/zscs/Public/static/css/school.css">
</head>

<body>
    <div class="site-block">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>类型名称</label>
                <div class="layui-input-block numschool">
                    <input type="hidden" class="c_name" value="<?php echo ($name['name']); ?>">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="add_type_name layui-input" value="<?php echo ($name['name']); ?>">
                </div>
            </div>
        </form>
    </div>
</body>
        <script src="/zscs/Public/static/layui/layui.js"></script>

</html>