<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Db;
use think\File;

class Img extends Com
{
    public function addImg(){
        return $this->fetch('img');
    }
    public function addImgDo(){
        $desc =input("post.desc");

        $file = request()->file('myfile');
        $file_name=$this->upload($file);
        $arr['oson_path']=$file_name;
        $arr['oson_desc']=$desc;
        $arr['add_time']=time();
        $res=DB::table("oson_img")->insert($arr);
        if($res){
            $this->success('新增成功', 'Img/showimg');
        }else{
            $this->error('新增失败');
        }

    }
    public function upload($file){
// 获取表单上传文件 例如上传了001.jpg

// 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
// 成功上传后 获取上传信息
// 输出 jpg
                //echo $info->getExtension();
// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                return  $info->getSaveName();
// 输出 42a79759f284b767dfcb2a0197904287.jpg
                // $info->getFilename();
            }else{
// 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
    public function showImg(){
        $data=DB::table("oson_img")->select();
        $this->assign('data',$data);
        return $this->fetch('showimg');
    }
    public function upImg(){
        $img_id=input("post.img_id");
        $status=input("post.status");
        if($status==0){
            $data['img_status']=1;
            $rs=db('oson_img')->where(array('img_id'=>$img_id))->update($data);
            if($rs){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            $data['img_status']=0;
            $rs=db('oson_img')->where(array('img_id'=>$img_id))->update($data);
            if($rs){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    public function delImg(){
        $img_id=input("post.img_id");
        $rs=db('oson_img')->where(array('img_id'=>$img_id))->delete();
        if($rs){
            echo 1;
        }else{
            echo 2;
        }
    }
}