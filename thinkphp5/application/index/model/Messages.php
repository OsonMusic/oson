<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Messages extends Model{
    protected  $tablename = "oson_message";

    //查询全部数据
  function display($display)
   {
      return Db::table($this->tablename)->where('display','=',$display)->select();
   }
   function Select($table)
   {
       $res = Db::table($table)->select();
       return $res;
   }

}