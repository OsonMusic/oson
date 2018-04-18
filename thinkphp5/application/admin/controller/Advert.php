<?php
namespace app\admin\controller;
use think\File;
use think\Request;
use think\Db;
class Advert  extends \think\Controller
{
    /*
     * 测试数据
     */
    public function index()
    {
        return "101";
    }

    public function advert()
    {
        return $this->fetch("advert");
    }

    /*
     * 添加操作
     */
    public function add()
    {
        $file = request()->file('file');
        $fileName = date("Ymd") . "/" . $this->file($file);
        $data = input('post.');
        $name = $this->xss($data['name']);
        $start_time = $this->xss($data['start_time']);
        $end_time = $this->xss($data['end_time']);
        $url = "http://" . $data['url'];
        $brief = $data['brief'];
        $sql = "INSERT INTO `oson_advert` (`advert_name`, `advert_url`, `advert_brief`, `start_time`, `end_time`, `advert_img`)
                VALUES ('$name', '$url', '$brief', '$start_time', '$end_time', '$fileName')";
        $res = Db::execute($sql);
        if ($res)
        {
            $session = $_SESSION['user_info']['user_id'];
//            $session = "1";
            $time = time();
            $ip = $_SERVER['SERVER_ADDR'];
            $sql_log = "INSERT INTO `oson_log` (`log_name`, `log_ip`, `log_time`, `session_id`) 
                        VALUES ('添加广告', '$ip', '$time', '$session')";
            $rest = Db::execute($sql_log);
            if ($rest)
            {
                $this->success("广告添加成功", url('Advert/advert'));
            }
        }
        else
        {
            $this->error();
        }
    }

    /*
     * 文件上传操作
     * $info = public/uploads
    */
    public function file($file)
    {
        $error = $_FILES['file']['error'];
        if ($error)
        {
            echo "<script>alert('文件上传失败！');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info)
        {
//            $fileName = $info->getFilename();
            $file = $info->getFilename();
            return $file;
        }
        else
        {
            $this->error($file->getError());
        }

    }
}
