<?php
namespace controllers; 

class UserController{
    //列表页
    public function index()
    {
        view('user/index');
    }
    //添加表单
    public function create()
    {
        view('user/create');
    } 
    //处理添加表单
    public function insert()
    {

    }

    //显示修改表单
    public function edit()
    {
        view('user/edit');
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