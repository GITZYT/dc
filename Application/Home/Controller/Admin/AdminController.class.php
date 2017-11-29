<?php
/**
 * Time: 0:19
 */

namespace Home\Controller\Admin;
use Think\Controller;

/**
 * Class LoginController
 */
class AdminController extends Controller {
    /**
     * 后台主页
     */
    public function index()
    {
       
        $this->display("Admin/index/index");
    }
    /**
     * 用户列表
     */
    public function userlist()
    {
        //用户列表
        $m=M('users');
       // $userid=session('uid');
        $where=array();
        //用户名称
        if(!empty($_POST['username'])){
            $where['username']=array('like','%'.$_POST['username'].'%');//表达式查询
            $this->username=$_POST['username'];
        }
        
        $p=getpage($m,$where,4);
        $list=$m->field(true)->where($where)->order('updatetime desc')->select();
        //         dump($list);
        $this->page=$p->show();
        $this->assign("list",$list);
        $this->display("Admin/user/user-list");
    }
    
    /**
     * 用户新增
     */
    public function adduser()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化User对象
            $user = D('users');
        
            // 自动验证 创建数据集
            if (!$data = $user->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }
        
            //插入数据库
            if ($id = empty($_POST['id'])?$user->add($data):$user->save($data)) {
             
                $this->success('保存成功', U('Home/Admin/Admin/userlist'), 2);
                
            } else {
              
                $this->error('保存失败');
            }
        } else {
            //              redirect(U('Home/adduser'), 1, '页面跳转中...');
        
            $uid=$_GET['id'];
            if(!empty($uid)){
                //处理编辑
                $user=M('users');
                $where['id']=$uid;
                $data=$user->where($where)->find();
                //                  var_dump($data);
                $this->assign('user',$data);
                $this->display("Admin/user/user-add");
            }else{
                $this->display("Admin/user/user-add");
            }
        
        }
    }
    
    /**
     * 是否启用
     */
    public function qy()
    {
        $uid=$_GET['id'];
        $isuse=$_GET['isuse'];
        
        $user=M('users');
        $where['id']=$uid;
        
        $user->where($where)->setField('isuse', $isuse);
        
        redirect( U('Home/Admin/Admin/userlist'), 0, '页面跳转中...');
    }
    /**
     * 用户删除
     */
    public function deleteuser()
    {
        // 判断提交方式
        if (IS_POST) {
            $ids=$_POST['ids'];
            //用户删除
            $m=M('users');
            if(!empty($ids)){
                //批量删除
                $datacheck = array();
                $datacheck=split(";", $ids);
                for ($i=0;$i<count($datacheck);$i+=1){
                    if(!empty($datacheck[$i])){
                        $where['id']=$datacheck[$i];
                        $m->where($where)->delete();
                    }
                }
                if($m!=false){
                    $data['status']=1;
                    $data['msg']="删除成功！";
                    $data['url']="userlist";//删除成功跳转至用户管理
                    $this->ajaxReturn($data,'JSON');
                }else{
                    $data['status']=2;
                    $data['msg']="删除失败！";
                    $data['url']="userlist";//删除成功跳转至用户管理
                    $this->ajaxReturn($data,"JSON");
                }
            }
        
        }else{
            redirect( U('Home/Admin/Admin/userlist'), 3, '页面跳转中...');
        } 
        
    }
    
    //测试
    public function test(){
    
        $hashval=hash("5","ddddddddddiiuujj");
        $hashval2=hash("5","ddddddddddiiuujj");
        $a="11";
        $b="22";
        $c="33";
        $this->a=$a;
        $this->assign("b",$b)->assign("c",$c);
    
        echo "hash值：".$hashval;
        echo "<br>";
        echo "hash值2：".$hashval2;
        echo "<br>";
    
        echo "__ACTION__".__ACTION__;
        echo "<br>";
        echo "__DIR__".__DIR__;
        echo "<br>";
        echo "__APP__".__APP__;
        echo "<br>";
        echo "__ROOT__".__ROOT__;
        echo "<br>";
        echo "__FILE__".__FILE__;
        echo phpinfo();
        $this->display("Index/test");
    }
    
}