<?php
/**
 * @Author: Marte
 * @Date:   2018-04-20 10:03:55
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-20 14:10:01
 */
namespace app\index\model;
use think\Model;
use think\Db;
class WebModel extends Model{
    // protected  $table = "oson_link";

    //添加一条数据
   function Select($table)
   {
       $res = Db::table($table)->select();
       return $res;
   }



}