<?php
namespace app\index\controller;
use app\index\model\Messages;
use think\Request;
use think\Db;
class Index extends \think\Controller
{

    public function index()
    {

    }
    public function show(){
        echo 22;
    }
    public function messages(){
        $message = new Messages;
        $data = $message->display('1');
        $this->assign("data",$data);
        return $this->fetch('messages');
    }
     public function Visitcontent(){

        if (Request::instance()->isAjax()){
            $visit_name     = trim($this->request->post('name'));
            // print_r($visit_name);die;
            $visit_msg      = trim($this->request->post('message'));
            $display        = $this->request->post('display');
            //过滤HTML标签
            $visit_message  = strip_tags($visit_msg);
            $visit_name     = strip_tags($visit_name);
            //获取留言用户IP
            $visit_ip       = $_SERVER['SERVER_ADDR'];

        }else{

            //如果不是AJAX提交返回错误
            echo "error";
            die;
        }
        $time = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `oson_message` (`msg_user`, `msg_name`, `msg_ip`, `msg_time`)
               VALUES ('$visit_name', '$visit_message', '$visit_ip', '$time')";
        $ret = Db::execute($sql);
    }
}
