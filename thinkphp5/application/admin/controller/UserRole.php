<?php
namespace app\admin\controller;
use  think\Controller;
use  think\Session;
use app\admin\model\UserRoleModel;
class User  extends  \think\Controller{
    /*
     * 用户id
     * */
        public $userId;
        public $Model;
    /*
     * 用户id通过构造赋值为全局
     * */
    public function __construct(){
        $this->userId  =  Session::get("user_info")['user_id'];
        $this->Model   =   new UserRoleModel();
    }

}