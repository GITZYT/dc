<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <meta name="renderer" content="webkit">
	    <title>后台管理中心</title>  
	    <link rel="stylesheet" href="/dc/Public/Css/pintuer.css">
	    <link rel="stylesheet" href="/dc/Public/Css/admin.css">
	    <script src="/dc/Public/Js/js/jquery.js"></script>
	    <script src="/dc/Public/Js/js/pintuer.js"></script> 
	    <script type="text/javascript" src="/dc/Public/Js/js/layer/layer.js" ></script>   
	</head>
	<body style="background-color:#f2f9fd;">
		<div class="header bg-main">
		  	<div class="logo margin-big-left fadein-top">
		    	<h1><img src="/dc/Public/images/y.jpg" class="radius-circle rotate-hover" style="height: 50px;" alt="" />后台管理中心</h1>
		  	</div>
		  	<div class="head-l">
		  		<a class="button button-little bg-green" href="/dc/Home/Index/Index/index" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;
		  		<a href="clearcatche" class="button button-little bg-blue"><span class="icon-wrench"></span> 清除缓存</a> &nbsp;&nbsp;
		  		<a class="button button-little bg-red" href="/dc/Home/Admin/Login/logout"><span class="icon-power-off"></span> 退出登录</a> 
		  	</div>
		  	<div class="head-r drop">
		  		<div class="drop">
        			<a href="javascropt:void(0)" class="dropdown-toggle"><?php echo ($user["username"]); ?>&nbsp;<img src="/dc/Public/images/y.jpg"/></a>
					<ul class="drop-menu">
						<li><a href="/dc/Home/Admin/Login/logout"><span class="icon-power-off margin-right"></span>退出</a> </li>
					</ul>
				</div>
		  	</div>
		</div>
		<div class="leftnav">
		  	<h2><span class="icon-user"></span>用户中心</h2>
		  	<ul>
		  		<li><a href="userlist" target="right"><span class="icon-tasks"></span>用户列表</a></li>
			    <li><a href="adduser" target="right"><span class="icon-plus-circle"></span>新增用户</a></li>
		  	</ul> 
		  	<h2><span class="icon-cubes"></span>分类管理</h2>
		  	<ul>
		  		<li><a href="categorylist" target="right"><span class="icon-tasks"></span>分类列表</a></li>
			    <li><a href="addcategory" target="right"><span class="icon-plus-circle"></span>新增分类</a></li>
		  	</ul> 
		  	<h2><span class="icon-folder-open-o"></span>文件管理</h2>
		  	<ul>
		  		<li><a href="filelist?flag=1" target="right"><span class="icon-folder-open"></span>普通文件管理</a></li>
			    <li><a href="filelist?flag=2" target="right"><span class="icon-folder-open text-red"></span>红头文件管理</a></li>
		  	</ul>
		  	
		</div>

		<script type="text/javascript">
			$(function(){
			  	$(".leftnav h2").click(function(){
				  	$(this).next().slideToggle(200);	
				  	$(this).toggleClass("on"); 
			  	})
			  	$(".leftnav ul li a").click(function(){
				    $("#a_leader_txt").text($(this).text());
			  		$(".leftnav ul li a").removeClass("on");
					$(this).addClass("on");
			  	})
			 	$(".leftnav").children("ul:last-child").css("padding-bottom","100px");
			});
		</script>	
		<div class="admin">
		  	<iframe scrolling="auto" rameborder="0" src="/dc/Home/Admin/Admin/userlist" name="right" width="100%" height="100%"></iframe>
		</div>
		
	</body>
</html>