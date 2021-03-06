<?php
namespace models;

class Role extends Model
{
    // 设置这个模型对应的表
    protected $table = 'role';
    // 设置允许接收的字段
    protected $fillable = ['role_name'];

    //添加。修改角色之后自动被执行
    //获取添加完之后的id ； $this->data['id']；
    protected function _after_write()
    {
        $stmt = $this->_db->prepare("INSERT INTO role_privlege(pri_id,role_id) VALUES(?,?)");
        foreach($_POST['pri_id'] as $v)
        {
            $stmt->execute([
                $v,
                $this->data['id'],
            ]);
        }
    }
    protected function _before_delete()
    {
        $stmt = $this->_db->prepare("delete from role_privlege where role_id=?");
        $stmt->execute([
            $_GET['id'],
        ]);
    }
}