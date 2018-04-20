<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class MessagesModel extends Model{
    protected  $tablename = "oson_message";

    //查询全部数据
   function Select($table)
   {
       $res = Db::table($table)->select();
       return $res;
   }

}