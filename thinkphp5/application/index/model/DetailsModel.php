<?php
namespace app\index\model;
use think\Model;
use think\Db;
class DetailsModel extends \think\Model
{
    public function com($table,$key,$str)
    {
        $res = Db::table($table)->where($key,$str)->select();
        return $res;
    }
}