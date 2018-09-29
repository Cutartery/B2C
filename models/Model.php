<?php
namespace models;

use PDO;

class Model{
    protected $_db;
    //操作的表名，具体的值由子类设置
    protected $table;
    //表单中的数据，值由子类来设置
    protected $data;

    public function __construct()
    {
        $this->_db = \libs\Db::make();
    }

    protected function _before_write(){}
    protected function _after_write(){}
        //删除之前被调用（钩子函数，定义好侯自动被调用）
    protected function _before_delete()
    {
        //如果是修改就删除图片
        if(isset($_GET['id']))
        {
            //先从数据库中取出原图片LOGO
            $ol = $this->findOne($_GET['id']);
            //删除
            @unlink(ROOT.'public'.$ol['logo']);
        }
    }
    protected function _after_delete(){}


    public function insert()
    {
        $this->_before_write();
        $keys=[];
        $values=[];
        $token=[];
        foreach($this->data as $k => $v)
        {
            $keys[] = $k;
            $values[] = $v;
            $token[] = '?';
        }
        $keys = implode(',',$keys);
        $token = implode(',',$token);
        $sql = "INSERT INTO {$this->table}($keys) VALUES($token)";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute($values);
        $this->data['id'] = $this->_db->lastInsertId();
        $this->_after_write();
    }
    public function update($id){
        $this->_before_write();
        $set = [];
        $token = [];

        foreach($this->data as $k => $v)
        {
            $set[] = '$k=?';
            $values[] = $v;
            $token[] = '?';
        }
        $set = implode(',',$set);
        $values[] = $id;
        $sql = "UPDATE {$this->table} SET $set WHERE id=?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute($values);
        $this->_after_write();
    }

    public function delete($id){
        $this->_before_delete();
        $stmt = $this->_db->prepare('DELETE FROM {$this->table} WHERE id=?');
        $stmt->execute([$id]);
        $this->_after_delete();

    }

    public function findAll($option=[]){
        $_option = [
            'fields' => '*',
            'where' => 1,
            'order_by' => 'id',
            'order_way' => 'desc',
            'per_page' =>20,
        ];
        //合并用户的配置
        if($option)
        {
            $_option = array_merge($_option,$option);
        }
        //翻页
        $page = isset($_GET['page'])?max(1,(int)$_GET['page']) : 1;
        $offset = ($page-1)*$_option['per_page'];
        $sql = "SELECT {$_option['fields']} 
                FROM {$this->table}
                WHERE {$_option['where']}
                ORDER BY {$_option['order_by']} {$_option['order_way']}
                LIMIT $offset,{$_option['per_page']}";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //获取总页数
        $stmt = $this->_db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE {$_option['where']}");
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_COLUMN);
        $pageCount = ceil($count/$_option['per_page']);
        $page_str = '';
        if($pageCount>1)
        {
            for($i=1;$i<=$pageCount;$i++)
            {
                $page_str .= '<a href="?page='.$i.'">'.$i.'</a>';
            }
        }
        return [
            'data'=>$data,
            'page'=>$page_str,
        ];
    }
    
    //获取
    public function findOne($id){
        $stmt = $this->_db->prepare("SELECT * FROM {$this->table} WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    //接收表单中的数据
    public function fill($data)
    {
        //判断是否在白名单中
        foreach($data as $k =>$v)
        {
            if(!in_array($k,$this->fillable))
            {
                unset($data[$k]);
            }
        }
        $this->data = $data;
    }
}