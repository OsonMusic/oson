<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;

class Index  extends Com
{
    public function index(){
        //return $this->fetch("index");
        $user_name=Session::get('user_info')['user_name'];
        $data=model('index')->selectAll();
        $digui=model('index')->getSontree($data);
        return view("Index/index",['user_name'=>$user_name,'data'=>$digui]);

    }
    public function head(){
        $user_name=Session::get('user_info')['user_name'];
        return view("Index/head",['user_name'=>$user_name]);
    }
    public function left(){
        $data=model('index')->selectAll();
        $digui=model('index')->getSontree($data);
        return view("Index/left",['data'=>$digui]);
    }

    public function  main(){
        return view("Index/main");
    }
    public function outLogin(){
        Session::delete('user_info');
        $user_info=Session::get("user_info");
        if(empty($user_info)){
            echo 1;
        }else{
            echo 2;
        }
    }
}
