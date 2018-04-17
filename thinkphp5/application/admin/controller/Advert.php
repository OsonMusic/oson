<?php
namespace app\admin\controller;
use think\File;
use think\Request;
class Advert  extends \think\Controller
{
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
        $data = input('post.');
//        print_r($data);die();
        $file = request()->file('file');
        $fileName = $this->file($file);


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
            echo "<script>alert('文件上传失败！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info)
        {
//            $fileName = $info->getFilename();
            $file     = $info->getSaveName();
            return $file;
        }
        else
        {
            $this->error($file->getError());
        }
    }
}
