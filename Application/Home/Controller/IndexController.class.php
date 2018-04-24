<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;

/**
 * 功能：管理员端的后台主页控制器
 * 作者：谢旷
 * 日期：2017/2/5
 */
class IndexController extends HomeBaseController {

	/**
	 * 后台主页的模板渲染
	 * @Author   谢旷
	 * @DateTime 2017-02-17
	 * @return   null     null
	 */
    public function index(){
    	$where = array('ttxw_sysuser.sysu_account' => session('account'));
    	$data = M('sysuser')->where($where)->join('ttxw_role ON ttxw_role.role_id = ttxw_role.role_id' )->field('ttxw_role.role_name role, ttxw_sysuser.sysu_name name, ttxw_sysuser.sysu_photo photo')->find();
    	$this->data = $data;
        $this->display();
    }

    /**
     * 后台页面中控制台的模板渲染
     * @Author   谢旷
     * @DateTime 2017-02-17
     * @return   null     null
     */
    public function main(){
    	$this->display();
    }

    /**
     * 获取侧边菜单的json数组
     * @Author   谢旷
     * @DateTime 2017-02-17
     * @return   json     菜单的json数组
     */
    public function GetMenu(){
        $this->ajaxReturn($data,'json');
    }

    /**
     * 获取子菜单
     * @param [type] $id [description]
     */
	public function GetSonMenu($id){
	    $SonMenu = M('menu')->field('menu_id,menu_name,menu_url,menu_icon')->where(array('menu_fid'=>$id))->select();
		return $SonMenu;
	}
	/**
	 * 获取列表菜单
	 */
	public function GetMenulist(){
		$lists = array();
		$map['role_id'] = session('role_id');
		$menus = M('role')->where($map)->select();
		$menus_array=explode(";", $menus[0]['role_menus']);//分隔菜单id
		$map2['menu_id'] = array('in',$menus_array);
		$map2['menu_fid'] = 0;
		//获取所有的顶级的菜单
		$topmenus = M('Menu')->field('menu_id,menu_name,menu_url,menu_icon')->where($map2)->select();
		for($i=0;$i<sizeof($topmenus);++$i){
			$lists[$i]['title'] = $topmenus[$i]['menu_name'];
			$lists[$i]['icon'] = $topmenus[$i]['menu_icon'];
			$lists[$i]['spread'] = false;
			$SonMenu = $this->GetSonMenu($topmenus[$i]['menu_id']);
			if (sizeof($SonMenu) == 0) {
				$lists[$i]['href'] = $topmenus[$i]['menu_url'];
			}else{
				for($j=0;$j<sizeof($SonMenu);++$j){
					$lists[$i]['children'][$j]['title'] = $SonMenu[$j]['menu_name'];
					$lists[$i]['children'][$j]['icon'] = $SonMenu[$j]['menu_icon'];
					$lists[$i]['children'][$j]['href'] = $SonMenu[$j]['menu_url'];
				}
			}
			
		}
		$this->ajaxreturn($lists,'json');
	}

}