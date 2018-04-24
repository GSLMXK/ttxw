<?php 

namespace Home\Model;
use Think\Model;

class ColumnModel extends Model {
	

	//得到所有数据
	public function getAll() {
		//进行分页配置
		$column = M("column");
		$total = $column->count();
		$listRow = 3;
		$page = new \Think\Page($total,$listRow);
		
		$page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page -> setConfig('header','共%TOTAL_ROW%条记录 第%NOW_PAGE%页/共%TOTAL_PAGE%页');
        $pagelist = $page->show();

		$pageinfo = $column->limit($page->firstRow,$page->listRows)->select();
		
		$info = array(
			'data'=>$pageinfo,
			'page'=>$pagelist,
		);

		return $info;
	}
}

