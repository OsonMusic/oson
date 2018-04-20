<?php
namespace app\admin\controller;
use think\File;
use think\Request;
use think\Db;
class Advert  extends \think\Controller
{
    /*
     * @刘柯
     * 测试数据
     */
    public function index()
    {
        return "101";
    }
    /*
     * @刘柯
     * 页面渲染
     * 2018/04/20 14:09
     */
    public function advert()
    {
        return $this->fetch("advert");
    }

    /*
     * @刘柯
     * 201804/20 14:07 修改
     * 添加操作
     */
    public function add()
    {
        $file                 = request()->file('file');
        $fileName             = date("Ymd") . "/" . $this->file($file);
        $data                 = input('post.');
        $name                 = $this->xss($data['name']);
        $start_time           = $this->xss($data['start_time']);
        $end_time             = $this->xss($data['end_time']);
        $url                  = "http://" . $data['url'];
        $brief                = $data['brief'];
        $data['advert_name']  = $name;
        $data['advert_url']   = $url;
        $data['advert_brief'] = $brief;
        $data['start_time']   = $start_time;
        $data['end_time']     = $end_time;
        $data['advert_img']   = $fileName;
        $res = Db::table("oson_advert")->insert($data);
        if ($res)
        {
            $session = $_SESSION['user_info']['user_id'];
            $time               = time();
            $ip                 = $_SERVER['SERVER_ADDR'];
            $rest['log_name']   = "添加广告";
            $rest['log_ip']     = $ip;
            $rest['log_time']   = $time;
            $rest['session_id'] = $session;
            $ret  = Db::table("oson_log")->insert($rest);
            if ($ret)
            {
                $this->success("广告添加成功", url('Advert/advert'));
            }
        }
        else
        {
            $sql = Db::table("oson_advert")->getLastSql();
//            return $sql;
            $this->error("异常，请联络管理员");
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
    /*
     * @刘柯
     * 2018/04/20 9:22
     * 展示翻页操作，kill李某
     */
    public function show()
    {
        $page    = input("get.page",1);
        $size    = 20;
        $offset  = ($page-1)*$size;
        $sql1    = "SELECT count(*) as num FROM `oson_music`";
        $count   = Db::query($sql1)['0']['num'];
        $sql2    = "SELECT * FROM `oson_music` LIMIT $offset,$size";
        $data    = Db::query($sql2);
        $best    = ceil($count/$size);
        $last    = $page-1<1?1:$page-1;
        $next    = $page+1>$best?$best:$page+1;
        $mbr     = Db::query($sql1);
        $this->assign("data",$data);
        $this->assign("best",$best);
        $this->assign("last",$last);
        $this->assign("next",$next);
        $this->assign("mbr",$mbr);
        return $this->fetch("show");
    }
    /*
     * @刘柯
     * 2018/04/20 9:33
     * 修改hot状态操作
     */
    public function hot()
    {
        $data        = input("post.");
        $hot         =$data['hot'];
        $rest['hot'] = $this->xss($hot);
        $id          = $data['id'];
        $res         = Db::table("oson_music")->where(array("music_id"=>$id))->update($rest);
        if($res)
        {
            echo "1";
        }
        else
        {
            $sql = Db::table("oson_music")->getLastSql();
            echo $sql;
        }
    }
    /*
     * @刘柯
     * 2018/04/20 9:56
     * 查询所有hot音乐
     */
    public function hotShow()
    {
        $page   = $this->xss(input("get.page",1));
        $size   = 20;
        $offset = ($page-1)*$size;
        $sql1   = "SELECT count(*) as num FROM `oson_music` WHERE `hot`='1'";
        $count  = Db::query($sql1)['0']['num'];
        $sql2   = "SELECT * FROM `oson_music` WHERE `hot`='1' LIMIT $offset,$size";
        $data   = Db::query($sql2);
        $best   = ceil($count/$size);
        $last   = $page-1<1?1:$page-1;
        $next   = $page+1>$best?$best:$page+1;
        $this->assign("data",$data);
        $this->assign("best",$best);
        $this->assign("last",$last);
        $this->assign("next",$next);
        return $this->fetch("hot");
    }
}
