<?php
namespace Home\Controller;
use Common\Controller\BaseController;

/**
 * 功能：新闻管理控制器
 * 作者：葛文芳
 * 日期：2017/5/30
 */
class NewsController extends BaseController {

    //获得搜索条件下的新闻信息
    public function News_index(){
        $map = array();
        $requestPage = I('requestPage',1);  //获得请求的页码数
        // $serach_type = I('serach_type','all');  //获得请求搜索的类型
        $keywords = I("content",'');       //获得请求搜索的关键字
        $start_date = I("start_date"); //获取开始日期
        $end_date = I("end_date");  //获取结束日期
        $del_flag = I('del_flag',0); //默认未删除
        $rows = 3;                          //每页显示的记录
        $flag = true;  //是否可以发布新闻
        $column = I('column','');
        $sysu = I('sysu','');
        //栏目
        if ($column != "") {
            $map['ttxw_news.column_id'] = $column;
        }
        //来源
        if ($sysu != "") {
            $map['ttxw_news.sysu_id'] = $sysu;
        }
        //输入内容
        if($keywords != "") {
            $map['ttxw_news.news_title|ttxw_news.news_content'] = array('like',"%".$keywords."%");
            // $map['ttxw_news.news_content'] = array('like',"%".$keywords."%");
        }
        $user_now = session('account');
        //查出当前用户的权限等级
        $role = M('sysuser')->where(array('sysu_account' => $user_now))->select();
        if ($role[0]['role_id'] != 1) {
            $map['ttxw_news.sysu_id'] = $role[0]['sysu_id'];
            $flag = false;
        }
        $map['ttxw_news.del_flag'] = $del_flag;
        $data = D('News')->getAll($map);
        // exit(var_dump($data['page']));
        // 返回前台的数据
        $this->assign("Data",$data['data']);
        $this->assign("page",$data['page']);
        $this->assign('requestPage', $requestPage);
        $this->assign('column', $column);
        $this->assign('del_flag', $del_flag);
        $this->assign('sysu', $sysu);
        $this->assign('content', $content);
        $this->assign('no_edit', $flag);
        // echo M('news')->getLastSql();
        // 找到名称相同的模版
        $this->display();
    }

    /**
     * 获得前台添加/修改新闻的页面
     * op:操作类型
     */
    public function News_operate($news_id='add') {
        
        //获得栏目 用于选择
        $column = M('column')->select(); 

        //添加界面
        if($news_id == 'add'){
            $this->assign('column',$column);
            $this->display();

        }else {
            //获得当前新闻数据
            $sc_data = M('news')->where(array('news_id'=>$news_id))->select();
            //不可编辑部分
            $edit = "no_edit";
            // exit(var_dump($type));
            $this->assign("edit",$eidt);
            $this->assign('column',$column);
            $this->assign('data',$sc_data[0]);
            $this->display();
        }

    }


    /**
     * 发布新闻
     */
    public function News_addNews(){
        if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        }else{
            $temp = $_POST;
            $data['news_content']=$temp['content'];
            $data['news_title']=$temp['title'];
            $data['column_id']=$temp['column'];
            $data['sysu_id']=session('sysu_id');
            $data['news_date']=date('Y-m-d H:i:s');
            $data['del_flag']=0;

            $isset = M('news')->data($data)->add(); //调用add添加
            if($isset){
                $result = array('success'=>true,'msg'=>'添加成功!');
            } else {
                $result = array('success'=>false,'msg'=>'添加失败!');
            }
        }
        // var_dump($isset);
        $this->ajaxReturn($result,'json');
    }

    //进行修改
    public function News_modifyNews(){
        if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        } else {
            $temp = $_POST;
            //进行数据组装
            $map['news_id'] = $temp['id'];
            $data['news_content']=$temp['content'];
            $data['news_title']=$temp['title'];
            $data['column_id']=$temp['column'];
            $data['sysu_id']=session('sysu_id');
            $data['news_date']=date('Y-m-d');
            $data['del_flag']=0;

            //更新数据
            $result = M('news')->where($map)->save($data);
            if($result == true){
                $req = array('success'=>true,'msg'=>'修改成功!');
            } else {
                $req = array('success'=>false,'msg'=>'修改失败!');
            }
            $this->ajaxReturn($req,'json');
        }
    }


    // //验证搜索
    // public function check_search() {
    //     if(!IS_POST){
    //         $data = array('success'=>false,'msg'=>'提交方式不正确');
    //     } else {
    //         $temp = $_POST;
    //         //模糊查询
    //         $serach[$temp['list']] = array('like',"%".$temp['content']."%"); 

    //         $data = M('news')->where($serach)->find();

    //         if($data == "") {
    //             $result = array('success'=>false,'msg'=>'查找内容不存在!');
    //         } else {
    //             $result = array('success'=>true,'msg'=>'内容存在!');
    //         }

    //         $this->ajaxReturn($result,'json');
    //     }
    // }


    //删除恢复新闻
    public function News_delete(){
        if(!IS_POST) {
             $data = array('success'=>false,'msg'=>'提交方式不正确');
         } else {
            $temp = $_POST;
            $data['del_flag'] = $temp['del_flag'];
            $result = M('news')->where(array('news_id'=>$temp['news_id']))->save($data);
            if($result != TRUE) {
                $data = array('success'=>false,'msg'=>'操作失败');
            } else {
                $data = array('success'=>true,'msg'=>'操作成功');
            }
         }
         return $this->ajaxReturn($data,'json');
    }

    

   


}