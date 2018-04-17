<?php
namespace app\admin\controller;
use app\admin\model\User;

class Login  extends \think\Controller
{
    public function index(){
        return $this->fetch("login/login");
    }
    public function loginDO(){
        $name = input('post.name');
//        print_r($name);die;
        $pwd = input('post.pwd');
        $user = new User();
        $res = $user->getLogin($name);
        print_r($res);







    }



}
