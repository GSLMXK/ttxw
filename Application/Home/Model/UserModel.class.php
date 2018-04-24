<?php
namespace Home\Model;
use Think\Model;

/**
 * 功能：User模型
 * 作者：许加明
 * 日期：2017-2-24 15:45:57
 */
class UserModel extends Model{

    /**
     * 自动验证设置
     */
    protected $_validate = array(
        array('user_account','',array('success'=>false,'msg'=>'账号已经使用！'),1,'unique',1),
    );

    /**
     * 使用自动完成来填写部分默认数据项
     */
    protected $_auto = array(
        array('password','setPass',1,'callback') , // 对password字段在新增的时候使setPass函数处理
        array('create_date', 'getTime', 1, 'callback'),     //新增数据时将创建时间设为当前时间
    );
    /**
     * 将头像路径存入数据库
     */
    public function savePhoto($id,$path){
        $info = null;
        $user = M('user');
        if($user->where(array('user_id'=>$id))->setField('user_photo',$path) !== false){
            $info = true;
        }else{
            $info = false;
        }
        return $info;
    }
    /**
     * 设置初始密码
     */
    public function setPass(){
        return sha1(md5('123456'));
    }

    /**
     * 获取当前时间
     */
    public function getTime(){
        return date('Y-m-d H:i:s', time());
    }

    /**
     * 本人修改信息
     */
    public function insertMyselfInfo(){
        $info = null;
        if(!$this->create()){
            $info = $this->packResult(false,$this->getError());
        }else{
            if($this->where(array('id'=>I('post.id')))->save() === false){
                $info = $this->packResult(false);
            }else{
                $info = $this->packResult(true);
            }
        }
        return $info;
    }
    /**
     * 管理员更新信息
     */
    public function updateInfoByManage(){
        //获得当前用户信息
        $user = D('Sysuser')->getMyselfInfo(session('account'));
        $info = null;
        if(!$this->create()){
            $info = $this->packResult(false,$this->getError());
        }else{
            if($user['role'] > I('role') ){
                $info = $this->packResult(false,'权限不够！');
            }else{
                if($this->save() === false){
                    $info = $this->packResult(false);
                }else{
                    $info = $this->packResult(true);
                }
            }
        }
        return $info;
    }

    /**
     * 管理员删除系统用户信息
     */
    public function deleteSysUserByManage(){
        $info = null;
        $id = I('post.id');
        if($this->where(array('id'=>$id))->setField('del_flag',0) === false){
            $info = $this->packResult(false);
        }else{
            $info = $this->packResult(true);
        }
        return $info;
    }
    
    /**
     * 通过id获取单个用户信息
     */
    public function getSysUserById($id){
        $sysUser = $this->field(array('id','account','name','sex','photo','phone','email','role','status','dept_id','remarks'))
            ->where(array('id'=>$id))->find();
        return $sysUser;
    }

    /**
     * 本人修改密码
     */
    public function fixPass(){
        $info = null;
        if(!$this->create()){
            $info = $this->packResult(false,$this->getError());
        }else{
            $this->password = md5(sha1(I('post.newPass')));
            if($this->where(array('id'=>I('post.id')))->save() === false){
                $info = $this->packResult(false);
            }else{
                $info = $this->packResult(true);
            }
        }
        return $info;
    }

    /**
     * 根据账号获得用户id
     */
    public function getId(){
        $account = session('account');
        $User = M('sysuser')->field(array('sysu_id'))->where(array('sysu_account'=>$account))->find();
        return $User['sysu_id'];
    }

    // /**
    //  * 将头像路径存入数据库
    //  */
    // public function savePhoto($path){
    //     $info = null;
    //     $sysu = M('sysuser');
    //     if($sysu->where(array('sysu_id'=>$this->getId()))->setField('sysu_photo',$path) !== false){
    //         $info = true;
    //     }else{
    //         $info = false;
    //     }
    //     return $info;
    // }

    /**
     * 根据筛选条件获取全部数据
     */
    public function getAllList($map){
        //页码信息
        $total = M('user')->where($map)->count();
        $listRow = 3;
        $page = new \Think\Page($total,$listRow);
        
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('header','共%TOTAL_ROW%条记录 第%NOW_PAGE%页/共%TOTAL_PAGE%页');
        $pagelist = $page->show();

        //当前条件下的新闻数据
        $list['user'] = M('user')->where($map)->limit($page->firstRow,$page->listRows)->select();
        
        $data = array(
            'data' => $list,
            'page' => $pagelist,
        );
        return $data;
    }
}