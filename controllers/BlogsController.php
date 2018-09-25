<?php
namespace controllers; 

class BlogsController{
    //列表页
    public function index()
    {
        view('blogs/index');
    }
    //添加表单
    public function create()
    {
        view('blogs/create');
    } 
    //处理添加表单
    public function insert()
    {

    }

    //显示修改表单
    public function edit()
    {
        view('blogs/edit');
    }
    //修改表单方法
    public function update()
    {

    }
    //删除
    public function delete()
    {

    }

}