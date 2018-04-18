<?php
namespace app\admin\controller;
use  think\Controller;
class User  extends  \think\Controller{

    public function showUser(){
        return view("/User/user");
    }


}