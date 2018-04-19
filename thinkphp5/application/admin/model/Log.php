<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Log extends Model{
    public $tablename="oson_log";
    public  function selectAll(){
        return DB::name($this->tablename)->select();
        //return  DB::query("SELECT * FROM oson_log");
    }
    public function seletcpage(){

    }

}