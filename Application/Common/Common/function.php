<?php
	/**
	 * 公共的方法类
	 */

	/**
	 * 调试时更好的打印数据的函数
	 * @Author   taolei
	 * @DateTime 2017-02-16
	 * @param    [array]     $data [需要打印的数组]
	 * @return   [String]         返回打印的拼接字符串
	 */
	function p($data){
	    // 定义样式
	    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
	    // 如果是boolean或者null直接显示文字；否则print
	    if (is_bool($data)) {
	        $show_data=$data ? 'true' : 'false';
	    }elseif (is_null($data)) {
	        $show_data='null';
	    }else{
	        $show_data=print_r($data,true);
	    }
	    $str.=$show_data;
	    $str.='</pre>';
	    echo $str;
	}
	/**
	 * 添加日志的公共方法
	 * @Author   taolei
	 * @DateTime 2017-02-16
	 * @param    [array]     $log [传入的日志记录数组]
	 */
	function addLog($log)
	{
	    /*$data = array(
	        "lname" => session("uname"),
	        "ltime" => time(),
	        "lip"   => get_client_ip(),
	    );*/
	    M('log')->add($data);
	}
?>