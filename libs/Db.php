<?php
//执行最底层的sql语句
//预处理prepare
//非预处理exec
namespace libs;

class Db
{
    private static $_obj = null;
    private function __clone(){}
    private $_pdo;
    
    private function __construct()
    {
        //链接数据库
        $this->_pdo = new \PDO('mysql:host=127.0.0.1;dbname=b2c','root','123456');
        //设置编码
        $this->_pdo->exec('SET NAMES utf8');
    }
    //返回唯一对象
    public static function make()
    {
        if(self::$_obj === null)
        {
            self::$_obj = new self;
        }
        return self::$_obj;
    } 
    //预处理
    public function prepare($sql)
    {
        return $this->_pdo->prepare($sql);
    }
    //非预处理
    public function exec($sql)
    {
        return $this->_pod->exec($sql);
    }
    //获取最新的id
    public function lastInsertId()
    {
        return $this->_pdo->lastInsertId();
    }
}