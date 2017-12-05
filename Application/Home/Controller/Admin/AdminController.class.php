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
     * 分类列表
     */
    public function categorylist()
    {
        //分类列表
        $m=M('category');
        $where=array();
        //名称
        if(!empty($_POST['name'])){
            $where['name']=array('like','%'.$_POST['name'].'%');//表达式查询
            $this->name=$_POST['name'];
        }
        
        $p=getpage($m,$where,4);
        $list=$m->field(true)->where($where)->order('addtime desc')->select();
        //         dump($list);
        $this->page=$p->show();
        $this->assign("list",$list);
        $this->display("Admin/category/type-list");
    }
    /**
     * 文件列表
     */
    public function filelist()
    {
        $flag=$_GET['flag'];
        //文件列表
        $m=M('file');
        $where=array();
        $where['flag']=$flag;
        //名称
        if(!empty($_POST['title'])){
            $where['title']=array('like','%'.$_POST['title'].'%');//表达式查询
            $this->title=$_POST['title'];
        }
        
        $p=getpage($m,$where,4);
        $list=$m->field(true)->where($where)->order('addtime desc')->select();
        //         dump($list);
        $this->page=$p->show();
        $this->assign("list",$list)->assign("flag",$flag);
        $this->display("Admin/file/file-list");
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
     * 分类新增
     */
    public function addcategory()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化category对象
            $cat = D('category');
        
            // 自动验证 创建数据集
            if (!$data = $cat->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($cat->getError());
            }
        
            //插入数据库
            if ($id = empty($_POST['id'])?$cat->add($data):$cat->save($data)) {
             
                $this->success('保存成功', U('Home/Admin/Admin/categorylist'), 2);
                
            } else {
              
                $this->error('保存失败');
            }
        } else {
            //              redirect(U('Home/adduser'), 1, '页面跳转中...');
        
            //树形分类
            $cat=D('category');
            $field = array('id','name','pid','level');
            $row = $cat->allCategory($field );
            //生成无限极分类
            $list=$cat->tree($row);
            //dump($list);
            $this->assign('row',$list);
            
            $id=$_GET['id'];
            if(!empty($id)){
                //处理编辑
                //$cat=M('category');
                $where['id']=$id;
                $data=$cat->where($where)->find();
                //                  var_dump($data);
                $this->assign('cat',$data);
                $this->display("Admin/category/type-add");
            }else{
                $this->display("Admin/category/type-add");
            }
        
        }
    }
  
    
    
    /**
     * 文件新增
     */
    public function addfile()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化file对象
            $cat = D('file');
        
            // 自动验证 创建数据集
            if (!$data = $cat->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($cat->getError());
            }
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','txt','csv','doc','xls','ppt','docx','xlsx');// 设置附件上传类型
            //$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
            $upload->rootPath = './Public/Uploads/';
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
           // dump($info);
            
            if(empty($data['id'])&&!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                
                //图片
                $savename =$info['picurl']['savename'];//名字
                $savepath =$info['picurl']['savepath'];//路径
               // dump($savepath.$savename);
                
                //文件
                $filename =$info['fileurl']['savename'];//名字
                $filepath =$info['fileurl']['savepath'];//路径
                //dump($filepath.$filename);
                
                if($savepath){
                    $data['picurl']=$savepath.$savename;
                }
               if($filepath){
                   $data['fileurl']=$filepath.$filename;
               }
               
                
                //插入数据库
                if ($id = empty($_POST['id'])?$cat->add($data):$cat->save($data)) {
                     
                    if($data['flag']==3){
                        $this->success('保存成功', U('Home/Index/Index/flist?item=1'), 2);
                    }else{
                        $this->success('保存成功', U('Home/Admin/Admin/filelist?flag='.$data['flag']), 2);
                    }
                
                } else {
                
                    $this->error('保存失败');
                }
            }
            
        } else {
            //              redirect(U('Home/adduser'), 1, '页面跳转中...');
            
            //树形分类
            $cat=D('category');
            $field = array('id','name','pid','level');
            $row = $cat->allCategory($field );
            //生成无限极分类
            $list=$cat->tree($row);
            //dump($list);
            $this->assign('row',$list);
            
            $id=$_GET['id'];
            $flag=$_GET['flag'];
            $this->assign("flag",$flag);
            if(!empty($id)){
                //处理编辑
                $cat=M('file');
                $where['id']=$id;
                $data=$cat->where($where)->find();
                //                  var_dump($data);
                $this->assign('cat',$data);
                $this->display("Admin/file/file-add");
            }else{
                $this->display("Admin/file/file-add");
            }
        }
    }
    
    /**
     * 是否启用
     */
    public function qy()
    {
        $id=$_GET['id'];
        $item=$_GET['item'];
        $isuse=$_GET['isuse'];
        $flag=$_GET['flag'];
        $obj=null;
        if($item==1){
            $obj=M("category");
        }else 
        if($item==2){
            $obj=M("file");
        }else {
            $obj=M('users');
        }
        $where['id']=$id;
        
        $obj->where($where)->setField('isuse', $isuse);
        if($item==1){
            redirect( U('Home/Admin/Admin/categorylist'), 0, '页面跳转中...');
        }else 
        if($item==2){
            redirect( U('Home/Admin/Admin/filelist?flag='.$flag), 0, '页面跳转中...');
        }else {
            redirect( U('Home/Admin/Admin/userlist'), 0, '页面跳转中...');
        }
       
    }
    /**
     * 删除
     */
    public function delete()
    {
        $item=$_GET["item"];
        // 判断提交方式
        if (IS_POST) {
            $ids=$_POST['ids'];
             $m=null;
            if($item==1){
                $m=M('category');
            }else 
            if($item==2){
                $m=M('file');
            }else {
                $m=M('users');
            }
           
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
                    $this->ajaxReturn($data,'JSON');
                }else{
                    $data['status']=2;
                    $data['msg']="删除失败！";
                    $this->ajaxReturn($data,"JSON");
                }
            }
        
        }else{
            redirect( U('Home/Admin/Admin/userlist'), 3, '页面跳转中...');
        } 
        
    }
    
    /**
     * 缓存清除
     */
    public function clearcatche()
    {
        header("Content-type: text/html; charset=utf-8");
       s(null);
       redirect( U('Home/Admin/Admin/index'), 0, '页面跳转中...');
    }
    
    //测试
    public function test2(){
        $this->display("Admin/category/type-modify");
        
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