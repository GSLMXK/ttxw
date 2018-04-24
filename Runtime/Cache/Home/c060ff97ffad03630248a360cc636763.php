<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>栏目管理</title>
              <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/css/school.css">
</head>

<body>
    <div class="school_content">
        <form class="layui-form">
            <div class="sys_menu">
                <div class="layui-form-item">
                    <div class="layui-input-block column_controll">
                        <button class="layui-btn layui-btn-radius reload">
                            <i class="layui-icon">&#x1002;</i>刷新</button>
                        <button type="hidden" lay-submit lay-filter="column" class="layui-btn layui-btn-radius column_add">
                            <i class="layui-icon">&#xe608;</i>增加</button>
                    </div>
                </div>
            </div>
        </form>
        <table class="layui-table" lay-even>
            <colgroup>
                <col>
                <col>
                <col width="30%">
            </colgroup>
            <thead>
                <tr>
                    <th>栏目名</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($Data)): foreach($Data as $key=>$v): ?><tr>
                        <td><?php echo ($v['column_name']); ?></td>
                        <td><?php echo ($v['comment']); ?></td>
                        <td>
                            <a class="layui-btn layui-btn-danger layui-btn-small modify_column" name="<?php echo ($v['column_id']); ?>">
                                <i class="layui-icon">&#xe642;</i>修改</a>
                            <a class="layui-btn layui-btn-warm layui-btn-small delete" name="<?php echo ($v['column_id']); ?>">
                                <i class="layui-icon">&#xe640;</i>删除</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div id="page"><?php echo ($page); ?></div>
    </div>
            <script src="/ttxw/Public/static/layui/layui.js"></script>
    <script type="text/javascript">
    var column_operate = "<?php echo U('Column/Column_operate');?>";
    var column_check = "<?php echo U('Column/Column_check');?>";
    var column_add = "<?php echo U('Column/Column_add');?>";
    var modify_check = "<?php echo U('Column/modify_check');?>";
    var column_modify = "<?php echo U('Column/Column_modify');?>";
    var delete_column = "<?php echo U('Column/delete_column');?>";
    </script>
    <script src="/ttxw/Public/static/js/column.js"></script>
</body>

</html>