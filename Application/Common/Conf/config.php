<?php
return array(
	//'配置项'=>'配置值'
    "URL_MODEL"=>2,//重写模式
    'URL_HTML_SUFFIX'       =>  'html|shtml|xml|htm',  // URL伪静态后缀设置
    'SESSION_PREFIX' => 'home', //session 前缀
    'CONTROLLER_LEVEL'      =>  2,//两级控制器
    
    
    
    //错误提示
     'SHOW_ERROR_MSG' =>    true,
    'ERROR_MESSAGE'  =>    '发生错误！', 
    //开启日志
     'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误 
  
    
    
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'dc',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123654',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'think_',    // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . '/Public',
        '__JS__' => __ROOT__ . '/Public/Js',
        '__CSS__' => __ROOT__ . '/Public/Css',
        '__IMAGE__' => __ROOT__ . '/Public/images',
        '__DATA__' => __ROOT__ . '/Public/Data',
        '__UPLOAD__' => __ROOT__ . '/Public/Uploads'
    ),
    
    
    
    
    );