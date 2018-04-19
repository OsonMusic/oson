<?php
/**
 * @Author: Marte
 * @Date:   2018-04-19 14:22:29
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-19 14:24:20
 */
namespace app\index\controller;
use app\index\model\Messages;
use think\Request;
use think\Db;
class Web extends \think\Controller
{
     public function index()
     {
         $model = new Messages();
         $data  = $model->Select("oson_advert");
         $this->assign("data",$data);
        return $this->fetch('index');
     }
}