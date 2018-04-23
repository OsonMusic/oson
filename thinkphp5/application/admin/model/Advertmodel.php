<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Advertmodel extends Model
{
    public $tablename = "oson_advert";

    public function insertData($data)
    {
        return Db::table($this->table)->insertGetId($data);
    }

    public function select($data = null)
    {
        $res = db($data)->select();
        return $res;
    }

    public function hotshow($table, $str)
    {
        $res = Db::table($table)->where('hot', $str)->select();
        return $res;
    }

    public function sql($sql)
    {
        $res = Db::query($sql);
        return $res;
    }

    public function com($table,$key,$str)
    {
        $res = Db::table($table)->where($key,$str)->select();
        return $res;
    }

}