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
         if($item==1){
            $where['flag']=3;
            $this->item=$item;
        }else{
            $where['flag'] = array('not in','3');
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
    
    
    public function test(){
        //绝对路径
        $url=$_SERVER['DOCUMENT_ROOT'];
        dump($url);
        
    }
    
    public function force_download($url)
    {
        
         $filename= './Public/Uploads/'.$url;
//          $filename= './Public/Uploads/2017-12-01/5a20c4c11c21d.jpg';
        if ($filename == ''){
            return FALSE;
        }
        if (FALSE === strpos($filename, '.')){
            return FALSE;
        }
        $x = explode('.', $filename);
        $extension = end($x);
        $mimes =$this->getMimes();
        // Set a default mime if we can't find it
        if ( ! isset($mimes[$extension])){
            $mime = 'application/octet-stream';
        }else{
            $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
        }
        // Generate the server headers
        if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE)
        {
            header('Content-Type: "'.$mime.'"');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header("Content-Transfer-Encoding: binary");
            header('Pragma: public');
            header("Content-Length: ".filesize($filename));
        }
        else
        {
            header('Content-Type: "'.$mime.'"');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header("Content-Transfer-Encoding: binary");
            header('Expires: 0');
            header('Pragma: no-cache');
            header("Content-Length: ".filesize($filename));
        }
        readfile($filename);
    }
    private function getMimes(){
        return $mimes = array(    'hqx'    =>    'application/mac-binhex40',
            'cpt'    =>    'application/mac-compactpro',
            'csv'    =>    array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'),
            'bin'    =>    'application/macbinary',
            'dms'    =>    'application/octet-stream',
            'lha'    =>    'application/octet-stream',
            'lzh'    =>    'application/octet-stream',
            'exe'    =>    array('application/octet-stream', 'application/x-msdownload'),
            'class'    =>    'application/octet-stream',
            'psd'    =>    'application/x-photoshop',
            'so'    =>    'application/octet-stream',
            'sea'    =>    'application/octet-stream',
            'dll'    =>    'application/octet-stream',
            'oda'    =>    'application/oda',
            'pdf'    =>    array('application/pdf', 'application/x-download'),
            'ai'    =>    'application/postscript',
            'eps'    =>    'application/postscript',
            'ps'    =>    'application/postscript',
            'smi'    =>    'application/smil',
            'smil'    =>    'application/smil',
            'mif'    =>    'application/vnd.mif',
            'xls'    =>    array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
            'ppt'    =>    array('application/powerpoint', 'application/vnd.ms-powerpoint'),
            'wbxml'    =>    'application/wbxml',
            'wmlc'    =>    'application/wmlc',
            'dcr'    =>    'application/x-director',
            'dir'    =>    'application/x-director',
            'dxr'    =>    'application/x-director',
            'dvi'    =>    'application/x-dvi',
            'gtar'    =>    'application/x-gtar',
            'gz'    =>    'application/x-gzip',
            'php'    =>    'application/x-httpd-php',
            'php4'    =>    'application/x-httpd-php',
            'php3'    =>    'application/x-httpd-php',
            'phtml'    =>    'application/x-httpd-php',
            'phps'    =>    'application/x-httpd-php-source',
            'js'    =>    'application/x-javascript',
            'swf'    =>    'application/x-shockwave-flash',
            'sit'    =>    'application/x-stuffit',
            'tar'    =>    'application/x-tar',
            'tgz'    =>    array('application/x-tar', 'application/x-gzip-compressed'),
            'xhtml'    =>    'application/xhtml+xml',
            'xht'    =>    'application/xhtml+xml',
            'zip'    =>  array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
            'mid'    =>    'audio/midi',
            'midi'    =>    'audio/midi',
            'mpga'    =>    'audio/mpeg',
            'mp2'    =>    'audio/mpeg',
            'mp3'    =>    array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
            'aif'    =>    'audio/x-aiff',
            'aiff'    =>    'audio/x-aiff',
            'aifc'    =>    'audio/x-aiff',
            'ram'    =>    'audio/x-pn-realaudio',
            'rm'    =>    'audio/x-pn-realaudio',
            'rpm'    =>    'audio/x-pn-realaudio-plugin',
            'ra'    =>    'audio/x-realaudio',
            'rv'    =>    'video/vnd.rn-realvideo',
            'wav'    =>    array('audio/x-wav', 'audio/wave', 'audio/wav'),
            'bmp'    =>    array('image/bmp', 'image/x-windows-bmp'),
            'gif'    =>    'image/gif',
            'jpeg'    =>    array('image/jpeg', 'image/pjpeg'),
            'jpg'    =>    array('image/jpeg', 'image/pjpeg'),
            'jpe'    =>    array('image/jpeg', 'image/pjpeg'),
            'png'    =>    array('image/png',  'image/x-png'),
            'tiff'    =>    'image/tiff',
            'tif'    =>    'image/tiff',
            'css'    =>    'text/css',
            'html'    =>    'text/html',
            'htm'    =>    'text/html',
            'shtml'    =>    'text/html',
            'txt'    =>    'text/plain',
            'text'    =>    'text/plain',
            'log'    =>    array('text/plain', 'text/x-log'),
            'rtx'    =>    'text/richtext',
            'rtf'    =>    'text/rtf',
            'xml'    =>    'text/xml',
            'xsl'    =>    'text/xml',
            'mpeg'    =>    'video/mpeg',
            'mpg'    =>    'video/mpeg',
            'mpe'    =>    'video/mpeg',
            'qt'    =>    'video/quicktime',
            'mov'    =>    'video/quicktime',
            'avi'    =>    'video/x-msvideo',
            'movie'    =>    'video/x-sgi-movie',
            'doc'    =>    'application/msword',
            'docx'    =>    array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'),
            'xlsx'    =>    array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip'),
            'word'    =>    array('application/msword', 'application/octet-stream'),
            'xl'    =>    'application/excel',
            'eml'    =>    'message/rfc822',
            'json' => array('application/json', 'text/json')
        );
        
        
    }   
    
}