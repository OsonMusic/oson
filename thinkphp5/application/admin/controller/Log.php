<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
class Log  extends Com
{
    public function index()
    {
        //echo 111;die();
        //$log=model('log')->selectAll();
        $page = input('get.page',1);
        $size=2;
        //$page=1;
        $offset=($page-1)*$size;

        $count=DB::query("SELECT COUNT(*) as num FROM oson_log")[0]['num'];
        $best=ceil($count/$size);
        $data=DB::query("SELECT * FROM oson_log LIMIT $offset,$size");
        $last=$page-1<1?1:$page-1;
        $next=$page+1>$best?$best:$page+1;
        //$log=DB::name("oson_log")->select();
        $this->assign('log',$data);
        $this->assign('best',$best);
        $this->assign('last',$last);
        $this->assign('next',$next);
        return $this->fetch("log");
    }


}
