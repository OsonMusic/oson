<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class CommentModel extends Model{
    public $tableName = "oson_comment";

    public function getComment(){
        $res = Db::query("SELECT oson_comment.*,oson_music.music_name FROM oson_comment INNER JOIN oson_music ON oson_comment.music_id = oson_music.music_id");
        return $res;
    }
    public function delComment($comment_id){
        $res =   Db::table($this->tableName)->where('comment_id',$comment_id)->delete();
        return $res;
    }
    public function statuComment($where,$id){
        $res = Db::table($this->tableName)->where('comment_id',$id)->update(['is_show' =>$where]);
//        return Db::table($this->tableName)->getLastSql();
        return $res;
    }

}