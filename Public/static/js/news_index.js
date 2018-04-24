layui.config({
    base: '../../Public/static/js/'
}).use(['layer', 'laypage', 'form', 'element'], function() {
    var layer = layui.layer,
        $ = layui.jquery,
        form = layui.form(),
        laypage = layui.laypage,
        element = layui.element()

    //学校信息管理
    form.on('submit(search)', function() {
        return false;
    });
    // var page = $('#page').html();
    // var curr = $('#curr').html();
    //page
    // laypage({
    //     cont: 'page',
    //     pages: page //总页数
    //         ,
    //     groups: 5 //连续显示分页数
    //         ,
    //     curr: curr, //获得当前页码
    //     jump: function(obj, first) {
    //         //得到了当前页，用于向服务端请求对应数据
    //         var curr = obj.curr;
    //         if (!first) {
    //             window.location.href = schoolInfo + "?requestPage=" + curr;
    //         }
    //     }
    // });



    //搜索
    $(".button_search").click(function() {
        var content = $(".content").val();
        content = HtmlUtil.htmlEncodeByRegExp(content);
        var column = $(".news_column").find("option:selected").val();
        var sysu = $(".news_sysu").find("option:selected").val();
        var del_flag = $('#flag').val();
        window.location.href = newsInfo + "?content=" + content + "&column=" + column + "&sysu=" + sysu + "&del_flag=" + del_flag;
    });

    $(".button_all").click(function() {
        window.location.href = newsInfo;
    });


    //刷新事件
    $(".reload").click(function() {
        var index = layer.load(0, { shade: false });
        window.location.reload();
    });

    //添加弹出框事件
    $(".add").click(function() {
        layer.open({
            type: 2,
            title: '发布新闻',
            // closeBtn: 0,
            btn: ['发布', '取消'],
            shadeClose: false,
            shade: false,
            shift: 4,
            maxmin: false, //开启最大化最小化按钮
            area: ['1000px', '530px'],
            content: news_operate,

            //确定事件
            yes: function(index, layero) {
                var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象
                var body = layer.getChildFrame('body', index);
                var text = iframeWin.getContent();      //调用子窗口的getcontent()方法
                text = text.replace(/&nbsp;/g," ");
                text = HtmlUtil.htmlEncodeByRegExp(text);
                //获得所有信息
                var title = body.find('.news_title').val();
                var column = body.find('.add_column').find("option:selected").val();

                //验证是否为空
                if (text == "" || title == "") {
                    layer.msg('请输入完整内容!');
                    return false;
                }else{
                    //进行添加事件
                    $.post(add_news, { title: title, column: column, content: text }, function(data, textStatus, xhr) {

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
                            $(".reload").click(); //刷新页面
                        }

                    });
                }

            },


        });
    });



    //进行新闻信息修改
    $(".modify").click(function() {
        //获得当前的id信息
        var news_id = $(this).attr("name");
        layer.open({
            type: 2,
            title: '修改新闻',
            // closeBtn: 0,
            btn: ['修改', '取消'],
            shadeClose: false,
            shade: false,
            shift: 4,
            maxmin: false, //开启最大化最小化按钮
            area: ['1000px', '530px'],
            content: news_operate + "?news_id=" + news_id,

            yes: function(index, layero) { //修改按钮

                var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象
                var body = layer.getChildFrame('body', index);
                var text = iframeWin.getContent();      //调用子窗口的getcontent()方法
                text = text.replace(/&nbsp;/g," ");
                text = HtmlUtil.htmlEncodeByRegExp(text);
                //获得所有信息
                var title = body.find('.news_title').val();
                var column = body.find('.add_column').find("option:selected").val();
                var news_id = body.find('.news_id').val();
                //验证是否为空
                if (text == "" || title == "") {
                    layer.msg('请输入完整内容!');
                    return false;
                }else{
                    //进行添加事件
                    $.post(modify_news, { id: news_id, title: title, column: column, content: text }, function(data, textStatus, xhr) {

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
                            $(".reload").click(); //刷新页面
                        }

                    });
                }

            },


        });
    });

    $(".recover").click(function() {
        var flag = $('#flag');
        if (flag.val() == 0) {
            // $('#flag_icon').html('&#xe621;');
            window.location.href = newsInfo + "?del_flag=1";
        }else{
            // $('#flag_icon').html('&#xe640;');
            window.location.href = newsInfo + "?del_flag=0";
        }
        
    });

    //删除新闻
    $(".delete").click(function(event) {
        var news_id = $(this).attr("name");
        var del_flag = $('#flag').val();
        var msg = '您确定删除该评论?';
        if (del_flag == 1) {
            msg = '您确定恢复该评论?';
            del_flag = 0;
        }else{
            del_flag = 1;
        }
        layer.confirm(msg, {
            btn: ['确定', '取消'] //按钮
        }, function() {

            $.post(delete_news, { news_id: news_id, del_flag: del_flag }, function(data, textStatus, xhr) {
                if (!data.success) {
                    layer.alert(data.msg, {
                        icon: 2,
                        title: '提示',
                    });
                } else {
                    layer.alert(data.msg, {
                        icon: 1,
                        title: '提示',
                    });
                    $(".reload").click();
                }
            });

        });



    });


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
});
