<?php 

namespace Home\Model;
use Think\Model;

/**
 * 功能：新闻管理模型
 * 作者：葛文芳
 * 日期：2017/5/30
 */
class NewsModel extends Model {

	//获取对应条件下的新闻及搜索下拉框的数据
	public function getAll($map) {
		//页码信息
		// $limit = ($requestPage-1) * $rows.','.$rows;	
		$total = M('news')->where($map)->count();
		$listRow = 3;
		$page = new \Think\Page($total,$listRow);
		
		$page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page -> setConfig('header','共%TOTAL_ROW%条记录 第%NOW_PAGE%页/共%TOTAL_PAGE%页');
        $pagelist = $page->show();

		//当前条件下的新闻数据
		$list['news'] = M('news')->join('ttxw_column ON ttxw_column.column_id = ttxw_news.column_id' )->join('ttxw_sysuser ON ttxw_sysuser.sysu_id = ttxw_news.sysu_id' )->field('ttxw_sysuser.sysu_name sname, ttxw_column.column_name cname, ttxw_news.news_id news_id, ttxw_news.news_date news_date, ttxw_news.news_title news_title, ttxw_news.news_content news_content, ttxw_news.del_flag del_flag')->where($map)->limit($page->firstRow,$page->listRows)->order('ttxw_news.news_date desc')->select();
		//所有栏目数据
		$list['column'] = M('column')->select();
		//所有头条号数据
		$list['publisher'] = M('sysuser')->where("role_id = 2")->select();
		// exit(var_dump($list));
		
		$data = array(
			'data' => $list,
			'page' => $pagelist,
		);
		return $data;
	}


	//获得修改的学校信息(用于前台展示)
	// public function modify_news($scid) {
	// 	//获得学校的信息
	// 	$schoolinfo = M('school')->where(array('news_id'=>$news_id))->select();
	// 	return $schoolinfo;
	// }


}

