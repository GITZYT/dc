<?php
/**

 */
namespace Home\Model;
use Think\Model;

class UsersModel extends Model {
    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
    protected $_validate = array(
        array('username', 'require', '用户名不能为空！'), //默认情况下用正则进行验证
        array('username', '', '该用户名已被添加！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        // 正则验证密码 [需包含字母数字以及@*#中的一种,长度为6-22位]
       array('password', '/^([a-zA-Z0-9@*#]{6,22})$/', '密码格式不正确,请重新输入！', 0,'function',1),//新增
        array('password', '/^([a-zA-Z0-9@*#]{6,22})$/', '密码格式不正确,请重新输入！', 2,'function',2),//编辑
        array('repassword', 'password', '确认密码不正确', 0, 'confirm'), // 验证确认密码是否和密码一致
        array('verify', 'verify_check', '验证码错误', 0, 'function'), // 判断验证码是否正确
    );

    /**
     * 自动完成
     */
    protected $_auto = array (
        array('password', 'md5', 1, 'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array("password","buildPass",2,"callback"),//编辑时增加判断 空则不修改密码
        
        array('registertime', 'time', 1, 'function'), // 对registertime字段在新增的时候写入当前时间戳
        array('isuse', 0), // isuse 0关闭 1启用  新增时 默认0
        array('updatetime', 'time', 3, 'function'), // 对updatetime字段在新增和编辑的时候写入当前时间戳
    );
    //编辑时密码为空判断
    public function buildPass($passwd) {
        return !empty($passwd) ? md5($passwd) : false;
    }
}