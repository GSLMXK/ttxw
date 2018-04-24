<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>高校管理</title>
              <link rel="stylesheet" type="text/css" href="/zscs/Public/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/zscs/Public/static/css/school.css">
</head>

<body>
    <div class="site-block">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>高校代码</label>
                <div class="layui-input-block numschool">
                    <input type="hidden" class="c_scid" value="<?php echo ($data['scid']); ?>">
                    <input type="hidden" class="c_name" value="<?php echo ($data['name']); ?>">
                    <input type="text" name="scid" required lay-verify="required" placeholder="请输入代码" autocomplete="off" class="add_scid layui-input" value="<?php echo ($data['scid']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>高校类别</label>
                <div class="layui-input-block numschool">
                    <select name="field" class='add_type'>
                        <?php if(is_array($type)): foreach($type as $key=>$v): ?><option <?php if(($v['type_id']) == $data['type_id']): ?>selected<?php endif; ?>
                                value="<?php echo ($v['type_id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>高校名称</label>
                <div class="layui-input-block numschool">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入代码" autocomplete="off" class="add_name layui-input" value="<?php echo ($data['name']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>高校隶属</label>
                <div class="layui-input-block numschool">
                    <input type="text" name="belong" required lay-verify="required" placeholder="请输入代码" autocomplete="off" class="add_belong layui-input" value="<?php echo ($data['belong']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>高校性质</label>
                <div class="layui-input-block numschool">
                    <select name="field" class="add_nature">
                        <option <?php if(($data['nature']) == "0"): ?>selected<?php endif; ?>
                            value="0" >公本</option>
                        <option <?php if(($data['nature']) == "1"): ?>selected<?php endif; ?>
                            value="1">公专</option>
                        <option <?php if(($data['nature']) == "2"): ?>selected<?php endif; ?>
                            value="2">民办</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>高校等级</label>
                <div class="layui-input-block numschool">
                    <select name="field" class="add_level">
                        <option <?php if(($data['level']) == "0"): ?>selected<?php endif; ?>
                            value="0">专科</option>
                        <option <?php if(($data['level']) == "1"): ?>selected<?php endif; ?>
                            value="1">本科</option>
                    </select>
                </div>
            </div>
            <button class="layui-btn" lay-submit lay-filter="add" style="display: none;">
        </form>
    </div>
</body>
        <script src="/zscs/Public/static/layui/layui.js"></script>
<script type="text/javascript">
var school = "<?php echo U('School/school');?>";
var check_add = "<?php echo U('School/check_add');?>";
var add_school = "<?php echo U('School/add_school');?>";
var check_modify = "<?php echo U('School/check_modify');?>";
var modify_school = "<?php echo U('School/modify_school');?>";
var search_school = "<?php echo U('School/search_school');?>";
var check_search = "<?php echo U('School/check_search');?>";
</script>
<script src="/zscs/Public/static/js/school.js"></script>

</html>