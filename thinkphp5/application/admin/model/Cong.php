<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Cong extends   Model
{
    public $tableName = "oson_config";
    public function isShow($str=''){
        $res =   Db::table($this->tableName)->where('is_show',$str)->find();
        return $res;
    }
    public function select($data = null)
    {
        $res = db($data)->select();
        return $res;
    }
    public function Find($data = null)
    {
        $res = db($data)->find();
        return $res;
    }
}

