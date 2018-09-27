<?php
namespace models;

class  Blogs extends Model{

    //设置这个模型对应的表
    protected $table = 'blog';
    //这只允许接受的字段
    protected $fillable = ['title','content','is_show'];


}