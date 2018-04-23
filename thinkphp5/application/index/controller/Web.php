<?php
/**
 * @Author: Marte
 * @Date:   2018-04-19 14:22:29
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-23 19:52:01
 */
namespace app\index\controller;
use app\index\model\WebModel;
use think\Request;
use think\Db;
class Web extends \think\Controller
{
     public $Model;
     public function __construct(){
     $this->Model   = new WebModel();
     }
     public function index()
     {
         $res1 = DB::query("SELECT * FROM `oson_music` order by rand() LIMIT 3");
         $res2 = DB::query("SELECT * FROM `oson_music` order by rand() LIMIT 3");
         $res3 = DB::query("SELECT * FROM `oson_music` order by rand() LIMIT 3");
         $ishot = DB::query("SELECT * FROM `oson_music` WHERE `hot` = '1' limit 4");
         $lubo=db('oson_img')->where(array('img_status'=>1))->select();
         $guangao=DB::table("oson_advert")->select();
        // print_r($guangao);die();
         // print_r($ishot);die;
         // print_r($res);die;
         $data  = $this->Model->Select("oson_link");
         // print_r($data);die;
         // $this->assign("data",$data);
        return view("index",['data'=>$data,'res1'=>$res1,'res2'=>$res2,'res3'=>$res3,'ishot'=>$ishot,'lunbo'=>$lubo,'gunagao'=>$guangao]);

     }

     public function msg(){
        $msg_data = input('post.');
        $msg_user = $this->xss($msg_data['msg_user']);
        $msg_name = $this->xss($msg_data['msg_name']);
        // print_r($msg_data);die;
        $msg_ip   = $_SERVER['SERVER_ADDR'];
        $msg_time = date("Y-m-d H:i:s");
        // print_r($user_ip);die;
        $sql = "INSERT INTO `oson_message` (`msg_user`, `msg_name`, `msg_ip`,`msg_time`)
                VALUES ('$msg_user', '$msg_name', '$msg_ip','$msg_time')";
        $ret = Db::execute($sql);
        if ($ret) {
            $this->success("留言发布成功，去留言板看看吧",'index/messages');
        }else{
            echo "<script>alert('啊哦~留言失败再给小欧一次机会再留一次言吧');</script>";
        }
        // echo "<script>alert('留言成功，去留言板看看吧');";
     }

}