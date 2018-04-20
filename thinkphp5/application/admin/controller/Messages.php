<?php
/**
 * @Author: Marte
 * @Date:   2018-04-20 14:17:31
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-20 16:19:39
 */
namespace app\admin\controller;
use app\admin\model\MessagesModel;
use think\Request;
use think\Db;
class Messages extends \think\Controller
{

     public $Model;
     public function __construct(){
        $this->Model  = new MessagesModel();
     }
    public function messages(){
            $page = input("get.page",1);
            $size = 15;
            $offset = ($page-1)*$size;
            $sql1  = "SELECT count(*) as num FROM `oson_message`";
            $count = Db::query($sql1)['0']['num'];
            $sql2  = "SELECT * FROM `oson_message` LIMIT $offset,$size";
            $data  = Db::query($sql2);
            $best  = ceil($count/$size);
            $last  = $page-1<1?1:$page-1;
            $next = $page+1>$best?$best:$page+1;
              // "data"=>$data,
            $arr = array(
                "dataall"=>$data,
                "best"=>$best,
                "last"=>$last,
                "next"=>$next,
                );
            // print_r($arr);die;
            // $this->assign("data",$data);
            // $this->assign("best",$best);
            // $this->assign("last",$last);
            // $this->assign("next",$next);
            // $data  = $this->Model->Select("oson_message");
             // print_r($arr);
             // $this->assign("data",$data);
            return view("MsgShow",["data"=>$arr]);
    }
             public function up()
            {
                $data        = input("post.");
                $display     = $this->xss($data['display']);
                $id          = $data['id'];
                $sql         = "UPDATE `oson_message` SET `display`='$display ' WHERE (`msg_id`='$id ')";
                $res         = Db::execute($sql);
                if($res)
                {
                    echo "1";
                }
                else
                {
                    $sql = Db::table("oson_massage")->getLastSql();
                    echo $sql;
                }
            }

            public function addLink(){

            }
}