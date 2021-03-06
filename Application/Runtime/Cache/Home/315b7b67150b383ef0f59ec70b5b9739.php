<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <meta name="renderer" content="webkit">
	    <title>用户列表</title>
	    <link rel="stylesheet" href="/dc/Public/Css/pintuer.css">
	    <link rel="stylesheet" href="/dc/Public/Css/admin.css">
	    <link rel="stylesheet" href="/dc/Public/Css/page.css">
	    <script src="/dc/Public/Js/js/jquery.js"></script>
	    <script src="/dc/Public/Js/js/pintuer.js"></script>
	    <script type="text/javascript" src="/dc/Public/Js/js/layer/layer.js" ></script>
	    <script type="text/javascript" src="/dc/Public/Js/jedate/jedate.js" ></script>
	</head>
	<body>
		<form method="post" action="" class="ttb">
		  	<div class="panel admin-panel">
			    <div class="panel-head"><strong class="icon-reorder"> 用户列表</strong></div>
			    <div class="padding border-bottom">
			    	<p>
			    		<button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
				        <a class="button border-red" href="javascript:void(0)" onclick="deleteall()"><span class="icon-trash-o"></span> 批量删除</a>
				        <a class="button border-main" href="/dc/Home/Admin/Admin/adduser"><span class="icon-plus"></span> 新增</a>
				        <form  id="formid" action="/dc/Home/Admin/Admin/userlist" method="post">
			  			<input type="text" name="username" value="<?php echo ($username); ?>" class="input input-auto margin-big-left" placeholder="输入用户名" />
			  			<!-- <a class="button border-main" href="javascript:search();"><span class="icon-search"></span> 搜索</a> -->
			  			<button class="button border-main" type="submit">搜索</button>
			  			</form>
			  		</p>
			    </div>
			    <div class="table-responsive">
				    <table class="table table-hover text-center">
				      	<tr>
				      		<!-- <th><input type="checkbox" name="ckall" value=""  /></th> -->
				      		<th></th>
					        <th>用户ID</th>
					        <th>用户名</th>       
					        <th>注册时间</th>
					        <th>操作</th>       
				      	</tr>      
				       <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
				        	<td><input type="checkbox" name="ckall" value="<?php echo ($vo["id"]); ?>" /></td>
				        	<td><?php echo ($vo["id"]); ?></td>
				        	<td><?php echo ($vo["username"]); ?></td>
				        	<td><?php echo (date('Y-m-d H:i:s',$vo["registertime"])); ?></td>
				          	<td>
			          				<div class="form-group" style="display: inline-block;">
										<div class="field text-blue border-main" >
											<div class="button-group radio">
												<label 
												<?php if($vo["isuse"] == 1): ?>class="button active"
												<?php else: ?>
												class="button"<?php endif; ?>
												
												>
													<input name="isuse" value="1" <?php if($vo["isuse"] == 1): ?>checked="checked"<?php endif; ?>  type="radio"> <a href="/dc/Home/Admin/Admin/qy?id=<?php echo ($vo["id"]); ?>&isuse=1"><span class="icon icon-check text-white"></span>启用</a>
												</label>
												<label 
												<?php if($vo["isuse"] == 0): ?>class="button active"
												<?php else: ?>
												class="button"<?php endif; ?>
												
												>
													<input name="isuse" value="0"  <?php if($vo["isuse"] == 0): ?>checked="checked"<?php endif; ?> type="radio"> <a href="/dc/Home/Admin/Admin/qy?id=<?php echo ($vo["id"]); ?>&isuse=0"><span class="icon icon-times"></span>关闭</a>
												</label>
											</div>
										</div>
									</div>
				          		<div class="button-group"> 
				          			<a class="button border-main" href="/dc/Home/Admin/Admin/adduser?id=<?php echo ($vo["id"]); ?>"><span class="icon-edit"></span> 编辑</a> 
				          			<a class="button border-red" href="javascript:void(0)" onclick="deleteall('<?php echo ($vo["id"]); ?>')"><span class="icon-trash-o"></span> 删除</a> 
				          		</div>
				          	</td>
				        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				      	<tr>
				        	<td colspan="10">
				        	
								<div class="pages">
				                        <?php echo ($page); ?>
				                </div>
				        	<!-- <div class="pagelist"> 
				        	<a href="">上一页</a> <span class="current">1</span><a href="">2</a><a href="">3</a><a href="">下一页</a><a href="">尾页</a> 
				        	</div> -->
				        	
				        	</td>
				      	</tr>
				    </table>
			    </div>
		  	</div>
		  	<input type='hidden' value="/dc/Home/Admin/Admin/delete" id="deleteurl">
		</form>
	 <script src="/dc/Public/Js/js/appled.js"></script>
</body>
</html>