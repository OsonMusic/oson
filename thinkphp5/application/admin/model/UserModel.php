<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class UserModel extends    Model{
    public $tableName = "oson_user";

    /*
     * 验证是否是超级管理
     * */
    public function isAdmin(){

    }
    /*
     * 添加管理
     * */
    public function addUser($arr=array()){

    }

}

