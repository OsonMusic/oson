<?php
namespace app\admin\controller;
use  think\Controller;
class Log  extends Controller
{
    public function index()
    {
        echo 111;die();
        return $this->fetch("log");

    }
    public function logmain(){
    	return $this->fetch("logmain");
    }
}
