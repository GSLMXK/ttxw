<?php 
namespace Home\Controller;
use Think\Controller;
/**
 * 功能：前台接口控制器
 * 作者：谢旷
 * 日期：2017/6/10
 */
class AppInterfaceController extends Controller {

	/**
	 * 获取栏目	
	 */
	public function getColumn() {
		$data = M('column')->select();
		$this->ajaxReturn($data,'json');
	}
	/**
	 * 获取新闻列表	
	 */
	public function getNewsList() {
		$map['column_id'] = I('id','');
		$data['news'] = M('news')->join('LEFT JOIN ttxw_sysuser ON ttxw_sysuser.sysu_id = ttxw_news.sysu_id')->where($map)->order('rand()')->limit(10)->select();
		for ($i=0; $i < sizeof($data['news']); $i++) { 
			$arr['news_id'] = $data['news'][$i]['news_id'];
			$arr['del_flag'] = 0;
			$data['news'][$i]['comment'] = M('comment')->join('RIGHT JOIN ttxw_user ON ttxw_comment.user_id = ttxw_user.user_id')->where($arr)->order('ttxw_comment.comment_date')->select();
		}
		$this->ajaxReturn($data,'json');
	}
	/**
	 * 获取新闻详情
	 */
	public function getNewsDetail() {
		$map['news_id'] = I('id','');
		$data['news'] = M('news')->join('LEFT JOIN ttxw_sysuser ON ttxw_sysuser.sysu_id = ttxw_news.sysu_id')->where($map)->select();
		for ($i=0; $i < sizeof($data['news']); $i++) { 
			$arr['news_id'] = $data['news'][$i]['news_id'];
			$arr['del_flag'] = 0;
			$data['news'][$i]['comment'] = M('comment')->join('RIGHT JOIN ttxw_user ON ttxw_comment.user_id = ttxw_user.user_id')->where($arr)->order('ttxw_comment.comment_date')->select();
		}
		$this->ajaxReturn($data,'json');
	}
	/**
	 * 获取个人信息
	 */
	public function getPersonal() {
		$map['user_id'] = I('user_id');
		$data = M('user')->where($map)->select();
		$this->ajaxReturn($data,'json');
	}
	/**
	 * 用户登录
	 */
	public function login() {
		$map['user_account'] = I('account');
		$map['user_pwd'] = sha1(md5(I('password')));
		$data = M('user')->where($map)->select();
		if ($data == null) {
			$data['msg'] = '密码或帐号错误';
			$data['status'] = 0;
		}else{
			if ($data[0]['state'] == 0) {
				$data['msg'] = '用户被锁定';
				$data['status'] = 2;
			}else{
				$data['msg'] = '登录成功';
				$data['status'] = 1;
			}
		}
		$this->ajaxReturn($data,'json');
	}
	/**
	 * 用户关注列表
	 */
	public function userFollow() {
		if(!IS_POST){
            $data = array('status'=>false,'msg'=>'提交方式不正确');
        }else{
            $umap['user_id'] = I('id');
        	$user = M('user')->where($umap)->select();
        	$data['user'] = $user;
            $str=$user[0]['user_follow'];
            $array=explode(";", $str);//分隔收藏id
            $map['sysu_id'] = array('in',$array);
            $data['sysu'] = M('sysuser')->where($map)->select();
        }
        $this->ajaxReturn($data,'json');
	}
	/**
	 * 用户收藏列表
	 */
	public function userCollect() {
		if(!IS_POST){
            $data = array('status'=>false,'msg'=>'提交方式不正确');
        }else{
        	$umap['user_id'] = I('id');
        	$user = M('user')->where($umap)->select();
        	$data['user'] = $user;
            $str=$user[0]['user_news'];
            $array=explode(";", $str);//分隔收藏id
            $map['news_id'] = array('in',$array);
            $data['news'] = M('news')->join('LEFT JOIN ttxw_sysuser ON ttxw_sysuser.sysu_id = ttxw_news.sysu_id')->where($map)->select();
			for ($i=0; $i < sizeof($data['news']); $i++) { 
				$arr['news_id'] = $data['news'][$i]['news_id'];
				$arr['del_flag'] = 0;
				$data['news'][$i]['comment'] = M('comment')->join('LEFT JOIN ttxw_user ON ttxw_user.user_id = ttxw_user.user_id')->where($arr)->order('ttxw_comment.comment_date')->select();
			}
        }
        $this->ajaxReturn($data,'json');
	}
	/**
	 * 用户注册
	 */
	public function register() {
		if(!IS_POST){
            $result = array('status'=>false,'msg'=>'提交方式不正确');
        }else{
            $data['user_account']=I('account');
            $data['user_pwd']=sha1(md5(I('password')));
            $data['user_follow']="";
            $data['user_news']="";
            $data['state']=1;
            // $data['del_flag']=0;
            $condition['user_account'] = $data['user_account'];
			// $condition['user_name'] = $data['name'];
			// $condition['_logic'] = 'OR';
            $arr = M('user')->where($condition)->select();
            if($arr){
            	$result = array('status'=>false,'msg'=>'该帐号已存在!');
            }else{
            	$isset = M('user')->data($data)->add();
	            if($isset){
	                $result = array('status'=>true,'msg'=>'注册成功!');
	            } else {
	                $result = array('status'=>false,'msg'=>'注册失败!');
	            }
            }
            
        }
        $this->ajaxReturn($result,'json');
	}
	/**
	 * 收藏新闻
	 */
	function collectNews(){
		if(!IS_POST){
            $data = array('status'=>false,'msg'=>'提交方式不正确');
        }else{
        	$user = M('user');
			$map['user_id'] = I('user_id');
			$data['user_news'] = I('news').I('news_id').';';
			$result = $user->where($map)->save($data);
			$result = array('user_news'=>$data['user_news'],'status'=>1,'msg'=>'已收藏');
        }
		
		return $this->ajaxReturn($result, 'json');
	}
	/**
	 * 取消收藏
	 */
	function cancelNews(){
		if(!IS_POST){
            $data = array('status'=>false,'msg'=>'提交方式不正确');
        }else{
        	$user = M('user');
			$map['user_id'] = I('user_id');
			$newsArray = explode(";", I('news'));//分隔收藏新闻id
	        $array = array();
			$array[0] = I('news_id');
	        //比较得出差值
	        $newsArray=array_diff($newsArray,$array);
	        $str = '';
	        foreach($newsArray as $key=>$val) {
	            if($val != ''){
	                $str .= $val.';';
	            }          
	        }
	        $data['user_news'] = $str;
			$result = $user->where($map)->save($data);
			$result = array('user_news'=>$str,'status'=>1,'msg'=>'已取消');
        }
		
		return $this->ajaxReturn($result, 'json');
	}
	/**
	 * 关注头条号
	 */
	function followSysu(){
		if(!IS_POST){
            $data = array('status'=>false,'msg'=>'提交方式不正确');
        }else{
        	$user = M('user');
			$map['user_id'] = I('user_id');
			$data['user_follow'] = I('follow').I('sysu_id').';';
			$result = $user->where($map)->save($data);
			$result = array('user_follow'=>$data['user_follow'],'status'=>1,'msg'=>'已关注');
        }
		
		return $this->ajaxReturn($result, 'json');
	}
	/**
	 * 取消关注
	 */
	function cancelFollow(){
		if(!IS_POST){
            $data = array('status'=>false,'msg'=>'提交方式不正确');
        }else{
        	$user = M('user');
			$map['user_id'] = I('user_id');
			$newsArray = explode(";", I('follow'));//分隔收藏新闻id
	        $array = array();
			$array[0] = I('sysu_id');
	        //比较得出差值
	        $newsArray=array_diff($newsArray,$array);
	        $str = '';
	        foreach($newsArray as $key=>$val) {
	            if($val != ''){
	                $str .= $val.';';
	            }          
	        }
	        $data['user_follow'] = $str;
			$result = $user->where($map)->save($data);
			$result = array('user_follow'=>$str,'status'=>1,'msg'=>'已取消');
        }
		
		return $this->ajaxReturn($result, 'json');
	}
	/**
	 * 修改个人信息
	 */
	function modifyInfo(){
		$user = M('user');
		$map['user_id'] = I('user_id');
		$data['comment'] = I('comment');
		$data['user_name'] = I('name');
		$result = $user->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $this->ajaxReturn($result, 'json');
	}
	/**
	 * 用户评论
	 */
	function userComment(){
		$comment = M('comment');
		$data['user_id'] = I('user_id');
		$data['news_id'] = I('news_id');
		$data['comment_fid'] = I('fid');
		$data['comment_content'] = I('content');
		$data['comment_date'] = date('Y-m-d H:i:s');
		$data['del_flag'] = 0;

		$result = $comment->add($data);
		if($result){
            $result = array('status'=>1,'msg'=>'评论成功!');
        } else {
            $result = array('status'=>0,'msg'=>'评论失败!');
        }
		return $this->ajaxReturn($result, 'json');
	}
	/**
	 * 修改密码
	 */
	function modifyPwd(){
		$user = M('user');
		$data['user_pwd'] = sha1(md5(I('password')));
		$map['user_id'] = I('id');
		$result = $user->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $this->ajaxReturn($result, 'json');
	}
	/**
	 * 用户上传头像
	 */
	public function updatePhoto()
    {
    	$id = I('id');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 1048576; //最大1m
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/User/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        $upload->saveName = 'user_' . $id;//'Sysuser_'+id
        $upload->saveExt = 'jpeg';//文件上传后缀
        $upload->replace = true; //直接覆盖
        $upload->autoSub = false;//不开启子目录

        $info = $upload->uploadOne($_FILES['photo']);

        if (!$info) {// 上传错误提示错误信息
            $arr['code'] = 0;
            $arr['msg'] = $upload->getError();
            $arr['data'] = array('src' => '');
        } else {// 上传成功
            $path = '/ttxw/Uploads/User/'.$info['savepath'] . $info['savename'];
            if (D('user')->savePhoto($id,$path)) {
                $arr['code'] = 1;
                $arr['msg'] = '头像更改成功！';
                $arr['data'] = array('src' => $path);
            } else {
                $arr['code'] = 0;
                $arr['msg'] = '头像保存异常';
                $arr['data'] = array('src' => '');
            }
        }
        return $this->ajaxReturn($arr, 'json');
    }
}
?>