<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 学生端的基类Controller 
 */
class StudentBaseController extends BaseController{
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();
        //下面写限定未登录不能访问其余模块的方法 
    }


}

