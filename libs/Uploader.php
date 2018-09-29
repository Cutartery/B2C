<?php
namespace libs;
class Uploader
{
    //不许呗new来生成对象
    private function __construct(){}
    private function __clone(){}
        //保存唯一对象
    private static $_obj = null;
    //提供一个公开的方法获取对象
    public static function make()
    {
        if(self::$_obj === null)
        {
            //生成一个对象
            self::$_obj = new self;
        }
        return self::$_obj;
    }
    private $_root = ROOT.'public/uploads/';//图片保存的唯一目录
    private $_ext = ['image/jpeg','image/jpg','image/ejpeg','image/png','image/gif','image/bmp'];  // 允许上传的扩展名
    private $_maxSize = 1024*1024*1.8; //最大允许上传的尺寸1.8M

    private $_file;//保存用户上传的图片信息
    private $_subDir;

    //上传图片
    //参数一.表单中文件名
    //参数二.保存到二级目录
    public function upload($name,$subdir)
    {
        //把用户图片的信息保存到属性上
        $this->_file = $_FILES[$name];
        $this->_subDir = $subdir;
    }
}