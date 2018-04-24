<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>系统用户管理</title>
              <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/css/school.css">
</head>
<style type="text/css">
    .line-limit-length {
        width:10px;height:20px;text-overflow:ellipsis; white-space:nowrap; overflow:hidden;
        /*white-space:nowrap;text-overflow:ellipsis;overflow:hidden;-webkit-text-overflow:ellipsis;height:50px*/
    }
    .layui-form-item {
        margin-bottom: 0px;
    }
</style>
<body>
    <div class="school_content">
        <form class="layui-form">
            <div class="sys_menu">
                <div class="layui-form-item">
                    <div class="layui-input-block" style="width: auto; height: auto;">
                      <div class="layui-form-pane">
                          <div class="layui-form-item">
                            <label class="layui-form-label">范围选择</label>
                            <div class="layui-input-inline">
                              <input class="layui-input" placeholder="开始日" id="beginDate">
                            </div>
                            <div class="layui-input-inline">
                              <input class="layui-input" placeholder="截止日" id="endDate">
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="layui-input-block">
                        <input type="text" name="content" placeholder="请输入内容" autocomplete="off" required class="layui-input  content">
                    </div>
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-radius button_search" lay-submit lay-filter="search">
                            <i class="layui-icon">&#xe615;</i>搜索</button>
                        <button class="layui-btn layui-btn-radius button_all">
                            <i class="layui-icon">&#xe615;</i>显示全部</button>
                    </div>
                    <br><br><br>
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-radius reload">
                            <i class="layui-icon">&#x1002;</i>刷新</button>
                        <button class="layui-btn layui-btn-radius add">
                            <i class="layui-icon">&#xe608;</i>注册头条号</button>
                    </div>
                    
                </div>
            </div>
        </form>
        <!-- 高校信息开始 -->
        <table class="layui-table" lay-even>
            <thead>
                <tr>
                    <th>用户名</th>
                    <th>帐号</th>
                    <th>创建日期</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($Data['sysuser'])): foreach($Data['sysuser'] as $key=>$v): ?><tr>
                        <td class="limit_length"><?php echo ($v['sysu_name']); ?></td>
                        <td class="limit_length"><?php echo ($v['sysu_account']); ?></td>
                        <td class="limit_length"><?php echo ($v['sysu_date']); ?></td>
                        <td><?php echo ($v['comment']); ?></td>
                        <td>
                            <a class="layui-btn layui-btn-normal layui-btn-small resetPwd" name="<?php echo ($v['sysu_id']); ?>">
                                <i class="layui-icon">&#xe640;</i>重置密码</a>
                            <a class="layui-btn layui-btn-warm layui-btn-small delete" name="<?php echo ($v['sysu_id']); ?>">
                                <i class="layui-icon">&#xe640;</i>删除</a>
                            <?php if(($v['state']) != "1"): ?><a class="layui-btn layui-btn-danger layui-btn-small motivate" name="<?php echo ($v['sysu_id']); ?>">
                                <i class="layui-icon">&#xe640;</i>激活</a><?php else: ?><a class="layui-btn layui-btn-success layui-btn-small lock" name="<?php echo ($v['sysu_id']); ?>">
                                <i class="layui-icon">&#xe640;</i>锁定</a><?php endif; ?>
                            
                        </td>
                    </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div id="page"><?php echo ($page); ?></div>
    </div>
    <!--窗口模板一-->
    <div class="window2" style="display: none">
        <form class="layui-form " method="post" action="">
            <!-- <input type="hidden" name="id" lay-verify="id" autocomplete="off" placeholder="" class="layui-input"  value="<?php echo ($userInfo["id"]); ?>"> -->
            <div class="layui-form-item">
                <label class="layui-form-label">账号:</label>
                <div class="layui-input-inline">
                    <input type="text" name="account" id="account" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" value="<?php echo ($userInfo["account"]); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">用户名:</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" id="name" lay-verify="required" autocomplete="off" placeholder="请输入内容" class="layui-input"  value="<?php echo ($userInfo["name"]); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备注:</label>
                <div class="layui-input-inline">
                    <input type="text" name="comment" id="comment" autocomplete="off" placeholder="请输入内容" class="layui-input"  value="<?php echo ($userInfo["email"]); ?>">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"> </label>
                <div class="layui-input-inline">
                    <div type="button" class="layui-btn" id="sureInfo" lay-submit="" lay-filter="submit1">提交</div>
                </div>
            </div>
        </form>
    </div>

    <!-- <div class="admin-table-page">
        <div id="page" class="page">
        </div>
    </div> -->
            <script src="/ttxw/Public/static/layui/layui.js"></script>
    <script type="text/javascript">
    var addSysUser = "<?php echo U('SysUser/SysUser_add');?>";
    var sysuInfo = "<?php echo U('SysUser/SysUser_manager');?>";
    var switchState = "<?php echo U('SysUser/SysUser_SwitchState');?>";
    var resetPwd = "<?php echo U('SysUser/SysUser_ResetPwd');?>";
    var check_modify = "<?php echo U('News/check_modify');?>";
    var modify_news = "<?php echo U('News/News_modifyNews');?>";
    var SysUser_delete = "<?php echo U('SysUser/SysUser_delete');?>";
    var check_search = "<?php echo U('News/check_search');?>";
    var rooturl = "/ttxw/";
    // var page = <?php echo ($page); ?>;
    // var curr = <?php echo ($requestPage); ?>;
    </script>
    <script src="/ttxw/Public/static/layui/lay/lib/jquery.js"></script>
    <script src="/ttxw/Public/static/js/sysUser_manager.js"></script>
    
    <script type="text/javascript">
    window.onload=function(){ 
        // var _divArr = document.getElementsByClassName('limit_length');  
        // var divLength = _divArr.length;
        // var content;
        // for(var i=0;i<divLength;i++){ 
        //     // alert(_divArr[0].innerHTML);
        //     content = cut(_divArr[i].innerHTML,9);
        //     _divArr[i].innerHTML = content;     
        // }  
    }
    /**
     * 截取指定长度字符串并转义
     * @param  {[type]} content [description]
     * @param  {[type]} length  [description]
     * @return {[type]}         [description]
     */
    function cut(content, length){
        var content = HtmlUtil.htmlDecodeByRegExp(content);
        content = content.substring(0,length)+'...';
        return content;
    }
    </script>
</body>

</html>