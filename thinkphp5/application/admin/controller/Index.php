<?php
namespace app\admin\controller;
use think\Controller;
class Index  extends Controller
{
    public function index(){
        return $this->fetch("index");
    }
    public function head(){
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
