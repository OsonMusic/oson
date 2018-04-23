<?php
namespace app\admin\controller;
use app\admin\model\Cong;
use think\File;
use think\Request;
use think\Controller;
use think\Db;
class Confg extends Controller
{
    protected $model;
//    function __construct()
//    {
//        $this->model = new Cong();
//    }

    /*
     * @刘柯
     * 2018/04/18
     * 展示主体
     */
    public function show()
    {
        $model = new Cong();

        $data   = $model->Find("oson_config");
        $this->assign("data",$data);
        return $this->fetch("show");
    }
    /*
     * @刘柯
     * 渲染修改View
     * 2018/04/18 20:02
     */
    public function update()
    {
        $model = new Cong();
        $data   = $model->isShow("1");
        $this->assign("data",$data);
        return $this->fetch("update");
    }
    /*
     * @刘柯
     * 修改操作
     * 2018/04/18 30:10
     */
    public function up()
    {
        $time  = time();
        $data  = input('post.');
        $title = $data['title'];
        $desc  = $data['desc'];
        $hread = $data['hread'];
        $rest['config_title'] = $title;
        $rest['config_desc']  = $desc;
        $rest['config_herad'] = $hread;
        $rest['config_time']  = $time;
        $id = '1';
        $res = db('oson_config')->where(array('config_id'=>$id))->update($rest);
        if($res)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
    /*
     * @刘柯
     * 修改状态
     * 2018/04/18 20:53
     */
    public function statu()
    {
        $data    = input("post.");
        $is_show = $data['where'];
        $sql     = "UPDATE `oson_config` SET `is_show`='$is_show' WHERE (`config_id`='1')";
        $res     = Db::execute($sql);
        if($res)
        {
            return "1";
        }
        else
        {
            $sql = Db::table("oson_config")->getLastSql();//获取最后一条SQL
            return "出错，联系管理员";
        }
    }
}