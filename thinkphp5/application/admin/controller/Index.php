<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;

class Index  extends Controller
{
    public function index(){
        return $this->fetch("index");
    }
    public function head(){
        $user_name=Session::get('user_info')['user_name'];
        $this->assign('user_name',$user_name);
        return $this->fetch("head");
    }
    public function left(){
        $data=model('index')->selectAll();
        $digui=model('index')->getSontree($data);
        //print_r($digui);

        $this->assign('data',$digui);
        return $this->fetch("left");
    }
    public function  main(){
        return $this->fetch("main");
    }
}
