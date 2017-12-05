<?php
namespace Home\Controller\Index;
use Think\Controller;
class IndexController extends Controller {
    
    public function index(){
          $index_username=session('index_username');
         $admin_username=session('username');
         if($index_username){
         $this->assign("username",$index_username);
         }
         if($admin_username){
         $this->assign("username",$admin_username);
         } 
        //左侧分类
        //树形分类
        $cat=D('category');
        $field = array('id','name','pid','level');
        $row = $cat->allCategory($field );
        //生成无限极分类
        $list=$cat->tree($row);
        $this->assign('row',$list);
        $this->display("Index/download");
    }
    
    public function flist(){
        
         $index_username=session('index_username');
        $admin_username=session('username');
        if($index_username){
            $this->assign("username",$index_username);
        }
        if($admin_username){
            $this->assign("username",$admin_username);
        } 
      
        
        $item=$_GET['item'];//1我的文件标识 2模板文件
        
        
        //文件列表
        $m=M('file');
        $where=array();
       
        //文件类型
        $type=$_GET['type'];
        if(!empty($type)){
            $where['type']=$type;
            $this->type=$type;
        }
        //名称
        if(!empty($_POST['title'])){
            $where['title']=array('like','%'.$_POST['title'].'%');//表达式查询
            $this->title=$_POST['title'];
        }
        
        $p=getpage($m,$where,8);
        $list=$m->field(true)->where($where)->order('addtime desc')->select();
        //         dump($list);
        $this->page=$p->show();
        $this->assign("list",$list);
        
     
        
        if($item==1){
            $this->assign("item",$item);
            $this->display("Index/file");
        }else {
            $this->display("Index/framedownload");
//             $this->display("Index/download");
        }
      
    }
}