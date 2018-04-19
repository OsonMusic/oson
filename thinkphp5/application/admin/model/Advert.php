<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Advert extends Model
{
    public $tablename = "oson_advert";
    public function insertData($data)
    {
        return Db::table($this->table)->insertGetId($data);
    }
}