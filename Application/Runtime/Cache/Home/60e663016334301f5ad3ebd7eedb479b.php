<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <meta name="renderer" content="webkit">
	    <title>编辑分类</title>  
	   <link rel="stylesheet" href="/dc/Public/Css/pintuer.css">
	    <link rel="stylesheet" href="/dc/Public/Css/admin.css">
	    <script src="/dc/Public/Js/js/jquery-1.8.3.min.js"></script>
<!-- 	    <script src="/dc/Public/Js/js/jquery.js"></script> -->
	    <script src="/dc/Public/Js/js/ajaxfileupload.js"></script>  
	    
	</head>
<body>
	
	<form name="fmAdd" method="post" novalidate >
       <table class="table table-condensed">
          <tr><th>选择文件</th><td><input type="file" 　name="uploadId" id="uploadId" />允许文件类型：.txt .csv</td></tr>
       </table>
       
        <input type="button" value="上传" />
    </form>
	
	
	<script>
	
	 $(function () {
         $(":button").click(function () {
             ajaxFileUpload();
         })
     })
     function ajaxFileUpload() {

	$.ajaxFileUpload({
        url: '/dc/Home/Admin/Admin/upload',
        secureuri: false,
        fileElementId: 'uploadId',
        dataType: 'json',
       /*  data:$("form[name=fmAdd]").serializeArray(), */
        success: function (data, status) {
           var data_obj = JSON.parse(data);
           console.log(data_obj);
        },
        error: function (data, status, e) {
            console.log('error');
            return;
        }      
    });
	};
	
	</script>
	
</body>
</html>