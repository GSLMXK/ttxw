<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>新闻管理</title>
              <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/ttxw/Public/static/css/school.css">
</head>
<style type="text/css">
    .layui-form-select dl{
        z-index:2147483647;
    }
</style>
<body>
    <div class="site-block">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>新闻标题</label>
                <div class="layui-input-block numschool">
                    <input type="hidden" class="news_id" value="<?php echo ($data['news_id']); ?>">
                    <input type="text" name="scid" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="news_title layui-input" value="<?php echo ($data['news_title']); ?>">
                </div>
            </div>
            <div class="layui-form-item" id="column_div">
                <label class="layui-form-label"><span>*</span>栏目</label>
                <div class="layui-input-block numschool">
                    <select name="field" class='add_column'>
                        <?php if(is_array($column)): foreach($column as $key=>$v): ?><option
                            <?php if(($v['column_id']) == $data['column_id']): ?>selected<?php endif; ?>
                                value="<?php echo ($v['column_id']); ?>"><?php echo ($v['column_name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
            </div>

            <div style="display: none" id="content"><?php echo ($data['news_content']); ?></div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>*</span>正文内容</label>
                <div id="editor">
                        <script id="edit_area" name="edit_area" type="text/plain"></script>
                        <!-- 编辑器css -->
                        <link href="/ttxw/Public/static/ueditor/themes/default/css/ueditor.css" type="text/css" rel="stylesheet">
                        <!-- jquery -->

                        <!-- 配置文件 -->
                        <script type="text/javascript" src="/ttxw/Public/static/ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="/ttxw/Public/static/ueditor/ueditor.all.js"></script>
                        <!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
                        <script type="text/javascript" src="/ttxw/Public/static/ueditor/lang/zh-cn/zh-cn.js"></script>
                        <script type="text/javascript">
                          var editor = UE.getEditor('edit_area',{
                            //imageUrl:'/ttxw/Admin/Ueditorup/ueditor?action=uploadimage',
                            //imagePath: "",
                            initialFrameWidth:"990",
                            initialFrameHeight:"400"
                          });
                        </script>
                      </div>
            </div>
           <!--  <div class="layui-form-item">
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
            </div> -->
            <button class="layui-btn" lay-submit lay-filter="add" style="display: none;"></button>
        </form>
    </div>
</body>
        <script src="/ttxw/Public/static/layui/layui.js"></script>
<script type="text/javascript">
// var text = <?php echo ($page); ?>;
</script>
<script src="/ttxw/Public/static/js/news_index.js"></script>
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
</script>
<script type="text/javascript">
    window.onload=function(){
        setContent();
    }
    function getContent(){
        var text = editor.getContent();
        return text;
    }
    function setContent(){
        var content = document.getElementById('content').innerHTML;
        var content = HtmlUtil.htmlDecodeByRegExp(content);
        editor.ready(function () { 
            editor.setContent(content);
        });
    }
</script>


</html>