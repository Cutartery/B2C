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
        $blog = new \models\Blogs;
        //为模型填充数据
        $blog->fill($_POST);
        //插入数据库
        $blog->insert();
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