<?php
namespace Home\Controller\Index;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        
        $username=session('index_username');
        $this->assign("username",$username);
        
        $this->display("Index/download");
    }
}