<?php
namespace Home\Controller;
use Think\Controller;
class UploadnewController extends Controller {
    public function index(){
    $this->display();
    }
    public function upload(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->savePath  =      './Image/'; // 设置附件上传目录
    $upload->autoSub = false;
    // 上传文件
    $info   =   $upload->upload();
    if(!$info) {
    // 上传错误提示错误信息
    $this->error($upload->getError());
    }else{
    // 上传成功
        echo "上传成功";
        }
    }
}
?>