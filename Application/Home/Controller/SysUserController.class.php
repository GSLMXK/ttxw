<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 功能：个人中心管理控制器
 * 作者：谢旷
 * 日期：2017/5/30
 */

class SysUserController extends HomeBaseController {

	/**
	 * 个人中心展示
	 */
	function SysUser_index(){
		$sysUser = M('sysuser');
		//得到session中的账户
		$user_now = session('account');
		//查找该账户信息模板赋值
		$userInfo = $sysUser->join('ttxw_role ON ttxw_sysuser.role_id = ttxw_role.role_id' )->field('ttxw_sysuser.sysu_name sname, ttxw_sysuser.sysu_account account, ttxw_sysuser.sysu_id sid, ttxw_sysuser.sysu_pwd sysu_pwd, ttxw_sysuser.sysu_photo sphoto, ttxw_sysuser.comment comment, ttxw_sysuser.sysu_date sdate, ttxw_role.role_name role_name')->where(array('ttxw_sysuser.sysu_account' => $user_now))->select();
		// var_dump($userInfo);
		//查询所有的角色，与用户匹配
		// $post_list = $posts->select();
		// $this->assign('post_list', $post_list);
		$this->assign('userInfo',$userInfo[0]);
		$this->display();
	}
	/**
	 * 修改个人信息
	 */
	function SysUser_modifyInfo(){
		$sysUser = M('sysuser');
		//得到session中的账户
		$user_now = session('account');
		$data['comment'] = $_POST['comment'];
		//查找该账户信息模板并修改
		$result = $sysUser->where(array('sysu_account' => $user_now))->save($data);
		$result['success'] = true;
		$result['msg'] = '修改成功';
		return json_encode($result);
	}
	/**
	 * 修改密码
	 */
	function SysUser_modifyPwd(){
		$sysUser = M('sysuser');
		//得到session中的账户
		$user_now = session('account');
		$data['sysu_pwd'] = sha1(md5($_POST['newPwd']));
		//查找该账户信息模板赋值
		$userInfo = $sysUser->where(array('sysu_account' => $user_now))->select();
		// echo md5(sha1($_POST['oldPwd']));
		if ($userInfo[0]['sysu_pwd'] == sha1(md5($_POST['oldPwd']))) {
			$arr = $sysUser->where(array('sysu_account' => $user_now))->save($data);
			$result['success'] = true;
			$result['msg'] = '修改成功';
		}else{
			$result['success'] = false;
			$result['msg'] = '原密码错误，修改失败';
		}
		return $this->ajaxReturn($result, 'json');
	}
    /**
     * 锁定/激活用户
     */
    function SysUser_SwitchState(){
        $sysUser = M('sysuser');
        $map['sysu_id'] = I('id');
        $data['state'] = I('state');
        $userInfo = $sysUser->where($map)->save($data);
        if ($userInfo) {
            $result['success'] = true;
            $result['msg'] = '修改成功';
        }else{
            $result['success'] = false;
            $result['msg'] = '修改失败';
        }
        return $this->ajaxReturn($result, 'json');
    }
    /**
     * 删除用户
     */
    public function SysUser_delete(){
        if(!IS_POST) {
             $data = array('success'=>false,'msg'=>'提交方式不正确');
         } else {
            $temp = $_POST;
            $sysu_news = M('news')->where(array('sysu_id'=>$temp['id']))->find();
            //该用户下存在新闻
            if ($sysu_news != null) {
                $data = array('success'=>false,'msg'=>'该用户下存在新闻，请先删除相关新闻');
            }else{
                $temp = $_POST;
                $result = M('sysuser')->where(array('sysu_id'=>$temp['id']))->delete();
                if($result == true) {
                    $data = array('success'=>true,'msg'=>'删除成功');
                } else {
                    $data = array('success'=>false,'msg'=>'删除失败');
                }
            }
         }
         return $this->ajaxReturn($data,'json');
    }
    /**
     * 重置用户密码
     */
    function SysUser_ResetPwd(){
        $sysUser = M('sysuser');
        $map['sysu_id'] = I('id');
        $data['sysu_pwd'] = sha1(md5(123456));  //重置为123456
        $userInfo = $sysUser->where($map)->save($data);
        if ($userInfo) {
            $result['success'] = true;
            $result['msg'] = '重置成功';
        }else{
            $result['success'] = false;
            $result['msg'] = '用户密码无修改或不可抗因素，重置失败';
        }
        return $this->ajaxReturn($result, 'json');
    }
	/**
	 * 用户上传头像
	 */
	public function SysUser_updatePhoto()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 1048576; //最大1m
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/UserPhoto/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        $upload->saveName = 'sysuser_' . D('Sysuser')->getId();//'Sysuser_'+id
        $upload->saveExt = 'jpeg';//文件上传后缀
        $upload->replace = true; //直接覆盖
        $upload->autoSub = false;//不开启子目录

        $info = $upload->uploadOne($_FILES['photo']);

        if (!$info) {// 上传错误提示错误信息
            $arr['code'] = 0;
            $arr['msg'] = $upload->getError();
            $arr['data'] = array('src' => '');
        } else {// 上传成功
            $path = '/ttxw/Uploads/UserPhoto/'.$info['savepath'] . $info['savename'];
            if (D('Sysuser')->savePhoto($path)) {
                if (D('Sysuser')->savePhoto($path)) {
                    $arr['code'] = 1;
                    $arr['msg'] = '头像更改成功！';
                    $arr['data'] = array('src' => $path);
                } else {
                    $arr['code'] = 0;
                    $arr['msg'] = '头像保存异常';
                    $arr['data'] = array('src' => '');
                }
            }
        }
        return $this->ajaxReturn($arr, 'json');
    }
    /**
     * 获得搜索条件下的系统用户信息
     */
    public function SysUser_manager(){
        $map = array();
        $requestPage = I('requestPage',1);  //获得请求的页码数
        // $serach_type = I('serach_type','all');  //获得请求搜索的类型
        $keywords = I("content",'');       //获得请求搜索的关键字
        $start_date = I("start"); //获取开始日期
        $end_date = I("end");  //获取结束日期
        $role = I('role_id',2); //默认展示头条号用户
        $rows = 3;                          //每页显示的记录
        if($keywords != "") {
            $map['sysu_name|sysu_account|comment'] = array('like',"%".$keywords."%");
        }
        if ($start_date != "" && $end_date != "") {
        	$map['sysu_date'] = array(array('egt', $start_date), array('elt', $end_date));
        }
        $map['role_id'] = $role;
        $data = D('Sysuser')->getAllList($map);

        $this->assign("Data",$data['data']);
        $this->assign("page",$data['page']);
        $this->assign('requestPage', $requestPage);
        $this->display();
    }
    /**
     * 注册头条号
     */
    public function SysUser_add(){
        if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        }else{
            $temp = $_POST;
            $data['sysu_account']=$temp['account'];
            $data['sysu_name']=$temp['name'];
            $data['sysu_pwd']=D('Sysuser')->setPass();
            $data['comment']=$temp['comment'];
            $data['sysu_date']=date('Y-m-d');
            $data['role_id']=2;
            $data['state']=1;
            // $data['del_flag']=0;
            $condition['sysu_account'] = $temp['account'];
			$condition['sysu_name'] = $temp['name'];
			$condition['_logic'] = 'OR';
            $arr = M('sysuser')->where($condition)->select();
            if($arr){
            	$result = array('success'=>false,'msg'=>'帐号信息已存在!');
            }else{
            	$isset = M('sysuser')->data($data)->add();
	            if($isset){
	                $result = array('success'=>true,'msg'=>'添加成功!');
	            } else {
	                $result = array('success'=>false,'msg'=>'添加失败!');
	            }
            }
            
        }
        $this->ajaxReturn($result,'json');
    }
}
?>