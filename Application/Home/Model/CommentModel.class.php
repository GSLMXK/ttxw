<?php 

namespace Home\Model;
use Think\Model;

/**
 * 功能：评论管理模型
 * 作者：许钰东
 * 日期：2017/5/30
 */
class CommentModel extends Model {

	//获取对应条件下的新闻及搜索下拉框的数据
	public function getAll($map) {
		//页码信息
		// $limit = ($requestPage-1) * $rows.','.$rows;	
		// $total = M('comment')->where($map)->count();
		$listRow = 3;
		$page = new \Think\Page($total,$listRow);
		
		$page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page -> setConfig('header','共%TOTAL_ROW%条记录 第%NOW_PAGE%页/共%TOTAL_PAGE%页');
        $pagelist = $page->show();
        
		//当前条件下的评论数据
		$list['comment'] = M('comment')->join('ttxw_news ON ttxw_comment.news_id = ttxw_news.news_id' )->join('ttxw_user ON ttxw_user.user_id = ttxw_comment.user_id' )->field('ttxw_comment.comment_content content, ttxw_news.news_title title, ttxw_user.user_name uname, ttxw_comment.comment_date comment_date, ttxw_comment.comment_id cid, ttxw_comment.del_flag del_flag')->where($map)->limit($page->firstRow,$page->listRows)->select();
		$total = sizeof($list['comment']);
		
		$data = array(
			'data' => $list,
			'page' => $pagelist,
		);
		return $data;
	}


}

