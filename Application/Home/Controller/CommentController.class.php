<?php
namespace Home\Controller;
use Common\Controller\BaseController;

/**
 * 功能：管理控制器
 * 作者：许钰东
 * 日期：2017/5/30
 */
class CommentController extends BaseController {

    //获得搜索条件下的评论信息
    public function Comment_index(){
        $map = array();
        $requestPage = I('requestPage',1);  //获得请求的页码数
        // $serach_type = I('serach_type','all');  //获得请求搜索的类型
        $keywords = I("content",'');       //获得请求搜索的关键字
        $start_date = I("start"); //获取开始日期
        $end_date = I("end");  //获取结束日期
        $del_flag = I('del_flag',0); //默认未删除
        $rows = 3;                          //每页显示的记录
        // $column = I('column','');
        // $sysu = I('sysu','');
        if($keywords != "") {
            $map['ttxw_news.news_title|ttxw_user.user_name|ttxw_comment.comment_content'] = array('like',"%".$keywords."%");
        }
        if ($start_date != "" && $end_date != "") {
            $map['ttxw_comment.comment_date'] = array(array('egt', $start_date), array('elt', $end_date));
        }
        // $user_now = session('account');
        // $role = M('sysuser')->where(array('sysu_account' => $user_now))->select();;
        // if ($role[0]['role_id'] != 1) {
        //     $map['ttxw_news.sysu_id'] = $role[0]['sysu_id'];
        // }
        $map['ttxw_comment.del_flag'] = $del_flag;
        if(session('role_id') == 2){
            $map['ttxw_news.sysu_id'] = session('sysu_id');
        }
        
        $data = D('Comment')->getAll($map);
        // exit(var_dump($data['page']));
        $this->assign("Data",$data['data']);
        $this->assign("del_flag",$del_flag);
        $this->assign("page",$data['page']);
        $this->assign('requestPage', $requestPage);
        // echo M('news')->getLastSql();
        $this->display();
    }




    //删除和恢复评论
    public function Comment_delete(){
        if(!IS_POST) {
             $data = array('success'=>false,'msg'=>'提交方式不正确');
         } else {
            $temp = $_POST;
            $data['del_flag'] = $temp['del_flag'];
            $result = M('comment')->where(array('comment_id'=>$temp['id']))->save($data);
            if($result != TRUE) {
                $data = array('success'=>false,'msg'=>'删除失败');
            } else {
                $data = array('success'=>true,'msg'=>'删除成功');
            }
         }
         return $this->ajaxReturn($data,'json');
    }

    

   


}