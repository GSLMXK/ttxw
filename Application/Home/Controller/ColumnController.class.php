<?php 
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 功能：栏目管理控制器
 * 作者：谢旷
 * 日期：2017/5/27
 */
class ColumnController extends HomeBaseController {
	/**
	 * 栏目管理首页
	 */
	public function Column_index(){
		$data = D('column')->getAll();
		$this->assign('Data',$data['data']);
		$this->assign('page',$data['page']);
		$this->display();
	}
	/**
	 * 栏目添加/修改界面
	 * @param  string $column_id [description]
	 * @return [type]          [description]
	 */
	public function Column_operate($column_id='add'){
		if($column_id == 'add') {
			$this->display();
		} else {
			$data = M('column')->where(array('column_id'=>$column_id))->select();
			$data[0]['name'] = $data[0]['column_name'];
			$this->assign('data',$data[0]);
			$this->display();
		}
	}

	/**
	 * 进行栏目添加验证
	 */
	public function Column_check() {
		if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        }else {
			$temp = $_POST;

			$result = M('column')->where(array('column_name'=>$temp['name']))->find();

			if($result != NULL) {
				$data = array('success'=>false,'msg'=>'栏目名称重复');
			} else {
				$data = array('success'=>true,'msg'=>'验证通过');
			}
		}
		$this->ajaxReturn($data,'json');
	}

	/**
	 * 添加
	 */
	public function Column_add() {
		if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        }else {
        	$temp = $_POST;
        	$v = array('column_name'=>$temp['name'],'comment'=>$temp['comment']);

        	$add = M('column')->add($v);
        	if($add == false) {
        		$data = array('success'=>false,'msg'=>'添加失败');
        	} else {
        		$data = array('success'=>true,'msg'=>'添加成功');
        	}
        }

        $this->ajaxReturn($data,'json');

	}

	/**
	 * 修改验证
	 * @return [type] [description]
	 */
	public function modify_check() {
		if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        }else {
			$temp = $_POST;
			//没有进行修改
			if($temp['c_name'] == $temp['name']) {
				$data = array('success'=>true,'msg'=>'验证成功');
			} else {
				$v = M('column')->where(array('column_name'=>$temp['name']))->find();
				//如果存在相同的信息
				if($v != NULL){
					$data = array('success'=>false,'msg'=>'栏目已经存在,请重新修改');
				} else {
					$data = array('success'=>true,'msg'=>'验证成功');
				}
			}
		}
		$this->ajaxReturn($data,'json');
	}

	//进行修改
	public function Column_modify(){
		if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        }else {
        	$temp = $_POST;
        	$data['column_name'] = $temp['name'];
        	$data['comment'] = $temp['comment'];
        	$result = M('column')->where(array('column_id'=>$temp['column_id']))->save($data);
        	if($result == true) {
	        	$data = array('success'=>true,'msg'=>'修改成功');
	        } else {
	        	$data = array('success'=>false,'msg'=>'修改失败');
	        }
        }
        $this->ajaxReturn($data,'json');
	}

	/**
	 * 删除栏目
	 * @return [type] [description]
	 */
	public function delete_Column() {
		if(!IS_POST){
            $data = array('success'=>false,'msg'=>'提交方式不正确');
        }else {
        	$temp = $_POST;
        	$col_news = M('news')->where(array('column_id'=>$temp['column_id']))->find();
        	//该栏目下存在新闻
        	if ($col_news != null) {
        		$data = array('success'=>false,'msg'=>'该栏目下存在新闻，请先删除相关新闻');
        	}else{
        		$temp = $_POST;
	        	$result = M('column')->where(array('column_id'=>$temp['column_id']))->delete();
	        	if($result == true) {
		        	$data = array('success'=>true,'msg'=>'删除成功');
		        } else {
		        	$data = array('success'=>false,'msg'=>'删除失败');
		        }
        	}
        }
        $this->ajaxReturn($data,'json');
	}

}
?>