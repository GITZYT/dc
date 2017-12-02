<?php
/**

 */
namespace Home\Model;
use Think\Model;

class CategoryModel extends Model {
    
    // 重新定义表
    protected $tableName = 'category';
    
    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
    protected $_validate = array(
        array('name', 'require', '类别名称不能为空！'), //默认情况下用正则进行验证
        array('level', 'require', '级别不能为空！'), //默认情况下用正则进行验证
        array('name', '', '该类别已被添加！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
       );

    /**
     * 自动完成
     */
    protected $_auto = array (
        array('addtime', 'time', 1, 'function'), // 对addtime字段在新增的时候写入当前时间戳
        array('isuse', 0), // isuse 0关闭 1启用  新增时 默认0
    );
 

  
   
    
    
}