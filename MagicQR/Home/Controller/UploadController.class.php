<?php
namespace Home\Controller;
use Think\Controller;
class UploadController extends Controller {
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
    public function up_voice($check_code){
    $rand_code = substr_replace($check_code,'*',2,1);
    $upload = new \Think\Upload();// 实例化上传类
    $voice = D('voice');
    $label = D('label');
    $title = I('post.title');//获取post过来的标题
    $content = I('post.content');//获取post过来的内容
    $question = I('post.question');//获取post过来的密码问题
    $answer = I('post.answer');//获取post过来的密码答案
    $time = date("Y-m-d H:i:s");//获取当前时间
    $result = $label ->where("rand_code = '$rand_code'")->find();
    $scan = ++$result['scan'];
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->savePath  =      './Voice/'; // 设置附件上传目录
    $upload->autoSub = false;
    // 上传文件
    $info   =   $upload->upload();
    if(!$info) {
    // 上传错误提示错误信息
    $this->error($upload->getError());
    }else{
    // 上传成功
        foreach ($info as $file) {
            $upload->saveName = 'time';//对图片进行重命名
            $filename = $file['savename'];//获取以保存的文件名及文件类型
            $filesize = $file['size'];//获取上传文件大小
            $data_voice['address'] .= 'http://api.yiqi8.me/Uploads/Voice/'.$filename.'+';
        }

    $data_voice['title'] = $title;//将要存到voice表的字段逐一赋值
    $data_voice['size'] = $filesize;
    $data_voice['time'] = $time;
    $data_voice['state'] = 2;

    $data_label['title'] = $title;//将要存到label(总表)的字段逐一赋值
    $data_label['content'] = $content;
    $data_label['question'] = $question;
    $data_label['answer'] = $answer;
    $data_label['time'] = $time;
    $data_label['type'] = 'V';
    $data_label['scan'] = $scan;
    

    $voice_save = $voice ->where("rand_code = '$rand_code'")->save($data_voice);//更新voice表
    $label_save = $label ->where("rand_code = '$rand_code'")->save($data_label);//更新label表
            if (!empty($voice_save)&&!empty($label_save)) {
                $this->success('上传成功！');
            }
        }
    }
    public function up_movie($check_code){
    $upload = new \Think\Upload();// 实例化上传类
    $rand_code = substr_replace($check_code,'*',2,1);
    $movie = D('movie');
    $label = D('label');
    $title = I('post.title');//获取post过来的标题
    $content = I('post.content');//获取post过来的内容
    $question = I('post.question');//获取post过来的密码问题
    $answer = I('post.answer');//获取post过来的密码答案
    $time = date("Y-m-d H:i:s");//获取当前时间
    $result = $label ->where("rand_code = '$rand_code'")->find();
    $scan = ++$result['scan'];
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->savePath  =      './Movie/'; // 设置附件上传目录
    $upload->autoSub = false;
    // 上传文件
    $info   =   $upload->upload();
    if(!$info) {
    // 上传错误提示错误信息
    $this->error($upload->getError());
    }else{
    // 上传成功
        foreach ($info as $file) {
            $upload->saveName = 'time';//对图片进行重命名
            $name = $file['name'];//获取以保存的文件名及文件类型
            $filename = $file['savename'];//获取以保存的文件名及文件类型
            $filesize = $file['size'];//获取上传文件大小
            $data_movie['address'] .= 'http://api.yiqi8.me/Uploads/Movie/'.$filename.'+';
        }

    $data_movie['title'] = $title;//将要存到movie表的字段逐一赋值
    $data_movie['size'] = $filesize;
    $data_movie['time'] = $time;
    $data_movie['state'] = 2;

    $data_label['title'] = $title;//将要存到label(总表)的字段逐一赋值
    $data_label['content'] = $content;
    $data_label['question'] = $question;
    $data_label['answer'] = $answer;
    $data_label['time'] = $time;
    $data_label['type'] = 'M';
    $data_label['scan'] = $scan;
    
    $movie_save = $movie ->where("rand_code = '$rand_code'")->save($data_movie);//更新movie表
    $label_save = $label ->where("rand_code = '$rand_code'")->save($data_label);//更新label表
            if (!empty($movie_save)&&!empty($label_save)) {
                $this->success('上传成功！');
            }
        }
    }
    public function up_image($check_code){
    $rand_code = substr_replace($check_code,'*',2,1);
    $upload = new \Think\Upload();// 实例化上传类
    $image = D('image');
    $label = D('label');
    $address = D('address');
    $title = I('post.title');//获取post过来的标题
    $content = I('post.content');//获取post过来的内容
    $question = I('post.question');//获取post过来的密码问题
    $answer = I('post.answer');//获取post过来的密码答案
    $time = date("Y-m-d H:i:s");//获取当前时间
    $result = $label ->where("rand_code = '$rand_code'")->find();
    $scan = ++$result['scan'];
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->savePath  =      './image/'; // 设置附件上传目录
    $upload->autoSub = false;
    // 上传文件
    $info   =   $upload->upload();
    if(!$info) {
    // 上传错误提示错误信息
    $this->error($upload->getError());
    }else{
    // 上传成功
        foreach ($info as $file) {
            $upload->saveName = 'time';//对图片进行重命名
            $filename = $file['savename'];//获取以保存的文件名及文件类型
            $filesize += $file['size'];//获取上传文件大小
            $data_image['address'] .= 'http://api.yiqi8.me/Uploads/Image/'.$filename.'+';
            $data_address['address'] = 'http://api.yiqi8.me/Uploads/Image/'.$filename;
            $data_address['rand_code'] = $rand_code;
            $data_address['check_code'] = $check_code;
            $address_save = $address ->add($data_address);//更新address表
        }

    $data_image['title'] = $title;//将要存到image表的字段逐一赋值
    $data_image['size'] = $filesize;
    $data_image['time'] = $time;
    $data_image['state'] = 2;

    $data_label['title'] = $title;//将要存到label(总表)的字段逐一赋值
    $data_label['content'] = $content;
    $data_label['question'] = $question;
    $data_label['answer'] = $answer;
    $data_label['time'] = $time;
    $data_label['type'] = 'I';
    $data_label['scan'] = $scan;
    
    $image_save = $image ->where("rand_code = '$rand_code'")->save($data_image);//更新image表
    $label_save = $label ->where("rand_code = '$rand_code'")->save($data_label);//更新label表
            if (!empty($image_save)&&!empty($label_save)&&!empty($address_save)) {
                $this->success('上传成功！');
            }
        }
    }
}
?>