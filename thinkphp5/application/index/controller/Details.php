<?php
namespace app\index\controller;
use app\index\model\DetailsModel;
use \think\Db;
class Details extends \think\Controller
{
    /*
     *@刘柯
     * 2018/04/23 10:16
     *音乐详情
     */
    public function details()
    {
        $id      = $_GET['id'];
//        $id      = "14";
        $model   = new DetailsModel();
        $data    = $model->com("oson_music","music_id",$id)['0'];//歌曲详情
        $comment = $model->com("oson_comment","music_id",$id);//评论数据
        $this->assign("data",$data);
        $this->assign("comment",$comment);
        return $this->fetch("details");
    }
    /*
     * @刘柯
     * 2018/04/23 14:55
     * 评论
     */
    public function detailsAdd()
    {
        $data = input("post.");
        $arr['music_id']  = $data['id'];
        $arr['comment_name'] = $data['message'];
        $arr['is_show'] = $data['is_show'];
        $arr['add_time']   = date("Y-m-d H:i:s");
        $res = Db::table("oson_comment")->insert($arr);
        if($res)
        {
            echo "1";
        }
        else
        {
            $sql  = Db::table("oson_comment")->getLastSql();
            echo "0";
        }

    }
}


