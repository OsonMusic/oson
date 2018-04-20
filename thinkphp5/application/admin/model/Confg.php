<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Confg extends   Model
{
    public $tableName = "oson_config";
    public function isShow($str=''){
        $res =   Db::table($this->tableName)->where('is_show',$str)->find();
        return $res;
    }
}

