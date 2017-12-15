<?php
/**

 */
namespace Home\Model;
use Think\Model;

class FileModel extends Model {
    
    // 重新定义表
    protected $tableName = 'file';
    
    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
    protected $_validate = array(
        array('title', 'require', '标题不能为空！'), //默认情况下用正则进行验证
        //array('title', '', '该标题已被添加！', 0, 'unique', 1), // 在新增的时候验证title字段是否唯一
       );

    /**
     * 自动完成
     */
    protected $_auto = array (
        array('addtime', 'time', 1, 'function'), // 对addtime字段在新增的时候写入当前时间戳
        array('isuse', 1), // isuse 0关闭 1启用  新增时 默认1
        array('islock', 1), // islock 0否 1解锁  新增时 默认1
        
        //用户id默认添加
        array("uid","functionuid",3,"callback"),//新增和编辑时添加用户id
      
    );
    
    //用户id
    public function functionuid() {

        $indexuid=session('index_uid');
        $adminuid=session('uid');
        $uid=null;
        if($indexuid){
            $uid=$indexuid;
        }
        if($adminuid){
           $uid=$adminuid;
        }
        return $uid;
    }
    
    
 
}