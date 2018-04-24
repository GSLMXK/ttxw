<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>评论管理</title>
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
                        <button class="layui-btn layui-btn-radius recover">
                            <!-- <input type="hidden" value="0" id="flag"> -->
                            <input type="hidden" name="id" lay-verify="id" autocomplete="off" placeholder="" class="layui-input"  value="<?php echo ($del_flag); ?>" id="flag">
                            <?php if(($del_flag) != "1"): ?><i class="layui-icon" id="flag_icon">&#xe640;</i>回收站
                                <?php else: ?>
                                <i class="layui-icon" id="flag_icon">&#xe621;</i>评论管理<?php endif; ?>
                          </button>
                    </div>
                    
                </div>
            </div>
        </form>
        <!-- 高校信息开始 -->
        <table class="layui-table" lay-even>
            <thead>
                <tr>
                    <th>新闻标题</th>
                    <th>评论内容</th>
                    <th>评论者</th>
                    <th>评论日期</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($Data['comment'])): foreach($Data['comment'] as $key=>$v): ?><tr>
                        <td class="limit_length"><?php echo ($v['title']); ?></td>
                        <td><?php echo ($v['content']); ?></td>
                        <td class="limit_length"><?php echo ($v['uname']); ?></td>
                        <td><?php echo ($v['comment_date']); ?></td>
                        <td>
                            <!-- <a class="layui-btn layui-btn-warm layui-btn-small delete" name="<?php echo ($v['cid']); ?>">
                                <i class="layui-icon">&#xe640;</i>删除</a> -->
                            <?php if(($v['del_flag']) != "0"): ?><a class="layui-btn layui-btn-normal layui-btn-small delete" name="<?php echo ($v['cid']); ?>">
                                <i class="layui-icon">&#xe640;</i>恢复</a><?php else: ?><a class="layui-btn layui-btn-warm layui-btn-small delete" name="<?php echo ($v['cid']); ?>">
                                <i class="layui-icon">&#xe640;</i>删除</a><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div id="page"><?php echo ($page); ?></div>
    </div>
    <!-- <div class="admin-table-page">
        <div id="page" class="page">
        </div>
    </div> -->
            <script src="/ttxw/Public/static/layui/layui.js"></script>
    <script type="text/javascript">
    var news_operate = "<?php echo U('Comment/Comment_operate');?>";
    var commentInfo = "<?php echo U('Comment/Comment_index');?>";
    var check_add = "<?php echo U('Comment/check_add');?>";
    var add_news = "<?php echo U('Comment/Comment_addComment');?>";
    var check_modify = "<?php echo U('Comment/check_modify');?>";
    var modify_news = "<?php echo U('Comment/Comment_modifyComment');?>";
    var delete_comment = "<?php echo U('Comment/Comment_delete');?>";
    var check_search = "<?php echo U('Comment/check_search');?>";
    // var page = <?php echo ($page); ?>;
    // var curr = <?php echo ($requestPage); ?>;
    </script>
    <script src="/ttxw/Public/static/layui/lay/lib/jquery.js"></script>
    <script src="/ttxw/Public/static/js/comment_index.js"></script>
    
    <script type="text/javascript">
    /**
     * html工具方法
     * @type {Object}
     */
    var HtmlUtil = {
        /*1.用浏览器内部转换器实现html转码*/
        htmlEncode:function (html){
            //1.首先动态创建一个容器标签元素，如DIV
            var temp = document.createElement ("div");
            //2.然后将要转换的字符串设置为这个元素的innerText(ie支持)或者textContent(火狐，google支持)
            (temp.textContent != undefined ) ? (temp.textContent = html) : (temp.innerText = html);
            //3.最后返回这个元素的innerHTML，即得到经过HTML编码转换的字符串了
            var output = temp.innerHTML;
            temp = null;
            return output;
        },
        /*2.用浏览器内部转换器实现html解码*/
        htmlDecode:function (text){
            //1.首先动态创建一个容器标签元素，如DIV
            var temp = document.createElement("div");
            //2.然后将要转换的字符串设置为这个元素的innerHTML(ie，火狐，google都支持)
            temp.innerHTML = text;
            //3.最后返回这个元素的innerText(ie支持)或者textContent(火狐，google支持)，即得到经过HTML解码的字符串了。
            var output = temp.innerText || temp.textContent;
            temp = null;
            return output;
        },
        /*3.用正则表达式实现html转码*/
        htmlEncodeByRegExp:function (str){  
             var s = "";
             if(str.length == 0) return "";
             s = str.replace(/&/g,"&amp;");
             s = s.replace(/</g,"&lt;");
             s = s.replace(/>/g,"&gt;");
             s = s.replace(/ /g,"&nbsp;");
             s = s.replace(/\'/g,"&#39;");
             s = s.replace(/\"/g,"&quot;");
             return s;  
       },
       /*4.用正则表达式实现html解码*/
       htmlDecodeByRegExp:function (str){  
             var s = "";
             if(str.length == 0) return "";
             s = str.replace(/&amp;/g,"&");
             s = s.replace(/&lt;/g,"<");
             s = s.replace(/&gt;/g,">");
             s = s.replace(/&nbsp;/g," ");
             s = s.replace(/&#39;/g,"\'");
             s = s.replace(/&quot;/g,"\"");
             return s;  
       }
    };
    window.onload=function(){ 
        var _divArr = document.getElementsByClassName('limit_length');  
        var divLength = _divArr.length;
        var content;
        for(var i=0;i<divLength;i++){ 
            // alert(_divArr[0].innerHTML);
            content = cut(_divArr[i].innerHTML,9);
            _divArr[i].innerHTML = content;     
        }  
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