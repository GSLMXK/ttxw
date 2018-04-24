<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 功能：App用户管理控制器
 * 作者：谢旷
 * 日期：2017/5/30
 */

class UserController extends HomeBaseController {

	/**
	 * APP用户首页视图显示
	 */
	public function User_index() {
		$map = array();
        $requestPage = I('requestPage',1);  //获得请求的页码数
        // $serach_type = I('serach_type','all');  //获得请求搜索的类型
        $keywords = I("content",'');       //获得请求搜索的关键字
        $start_date = I("start"); //获取开始日期
        $end_date = I("end");  //获取结束日期
        // $role = I('role_id',2); //默认展示头条号用户
        $rows = 3;                          //每页显示的记录
        if($keywords != "") {
            $map['user_name|user_account|comment'] = array('like',"%".$keywords."%");
        }
        $data = D('user')->getAllList($map);

        $this->assign("Data",$data['data']);
        $this->assign("page",$data['page']);
        $this->assign('requestPage', $requestPage);
        $this->display();
	}
	/**
     * 锁定/激活用户
     */
    function User_SwitchState(){
        $user = M('user');
        $map['user_id'] = I('id');
        $data['state'] = I('state');
        $userInfo = $user->where($map)->save($data);
        if ($userInfo) {
            $result['success'] = true;
            $result['msg'] = '操作成功';
        }else{
            $result['success'] = false;
            $result['msg'] = '操作失败';
        }
        return $this->ajaxReturn($result, 'json');
    }
    /**
     * 重置用户密码
     */
    function User_ResetPwd(){
        $user = M('user');
        $map['user_id'] = I('id');
        $data['user_pwd'] = sha1(md5(123456));  //重置为123456
        $userInfo = $user->where($map)->save($data);
        if ($userInfo) {
            $result['success'] = true;
            $result['msg'] = '重置成功';
        }else{
            $result['success'] = false;
            $result['msg'] = '用户密码无修改或不可抗因素，重置失败';
        }
        return $this->ajaxReturn($result, 'json');
    }
}
?>