<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Advert extends Model
{
    public $tablename = "oson_advert";
    public function insertData($data)
    {
        return Db::table($this->table)->insertGetId($data);
    }
}