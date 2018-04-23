<?php
namespace app\admin\Controller;
use app\admin\model\CommentModel;
use think\Controller;
use think\Db;
use think\Session;
class Comment extends Controller{

    public $userId;

    public $Model;

    public function __construct(){
        $this->Model   =   new CommentModel();
    }
    public function index(){
        $comArr = $this->Model->getComment();
//        print_r($comArr);die;
        return  view("Comment/comlist",["data"=>$comArr]);
    }
    public function DelComment(){
        $comment_id =  $this->xss(input("post.comment_id"));
        $res    =  $this->Model->delComment($comment_id);
        if($res){
            exit(json_encode(array("e"=>1,"m"=>'删除成功')));
        }else{
            exit(json_encode(array("e"=>2,"m"=>'删除失败')));
        }
    }
    public function UpComment(){
        $id    =  $this->xss(input("post.id"));
        $where =  $this->xss(input("post.where"));
        if($where==1){
            $where=0;
        }else{
            $where=1;
        }
        $res    =  $this->Model->statuComment($where,$id);
//        print_r($res);
        if($res){
            exit(json_encode(array("e"=>1,"m"=>'修改成功')));
        }else{
            exit(json_encode(array("e"=>2,"m"=>'修改失败')));
        }

    }







}