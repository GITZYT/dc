<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <meta name="renderer" content="webkit">
	    <title>新增用户</title>  
	    <link rel="stylesheet" href="/dc/Public/Css/pintuer.css">
	    <link rel="stylesheet" href="/dc/Public/Css/admin.css">
	    <script src="/dc/Public/Js/js/jquery.js"></script>
	    <script src="/dc/Public/Js/js/pintuer.js"></script>  
	    <script type="text/javascript" src="/dc/Public/Js/layer/layer.js" ></script>
	    <script type="text/javascript" src="/dc/Public/Js/jedate/jedate.js" ></script>
	</head>
	<body>
		<form id="formid" method="POST" action="/dc/Home/Admin/Admin/adduser?id=13" class="ttb">
		<input type="hidden" name="id" value="<?php echo ($user["id"]); ?>" />
		  	<div class="panel admin-panel">
			    <div class="panel-head"><strong class="icon-reorder"> <?php echo ($user?"编辑用户":"新增用户"); ?></strong></div>
			    <div class="table-responsive">
				    <table class="table notableborder">
						<tbody>
							<tr>
								<td class="x3 text-right line-height"><span>用户名：</span></td>
								<td class="x9"><input type="text" name="username" value="<?php echo ($user["username"]); ?>" class="input input-auto" placeholder="这里输入用户名" /></td>
							</tr>
							<!--<tr>
								<td class="x3 text-right line-height"><span>用户状态：</span></td>
								<td class="x9">
									<select class="input input-auto">
										<option>启用</option>
										<option>禁用</option>
									</select>
								</td>
							</tr>-->
							<tr>
								<td class="x3 text-right line-height"><span>用户状态：</span></td>
								<td class="x9">
									<select name="state" class="input input-auto">
										<option value=1 <?php if($user["state"] == 1): ?>selected="selected"<?php endif; ?>>红头文件</option>
										<option value=2 <?php if($user["state"] == 2): ?>selected="selected"<?php endif; ?>>普通文件</option>
									</select>
								</td>
							</tr>
							<?php if(empty($user)): ?><tr>
									<td class="x3 text-right line-height"><span>设置密码：</span></td>
									<td class="x9">
										<input type="password" name="password"  class="input input-auto" placeholder="这里输入密码" />
									</td>
								</tr>
							<?php else: ?>
							<tr>
								<td class="x3 text-right line-height"><span>原密码：</span></td>
								<td class="x9">
									<input type="password" name="password"  class="input input-auto" placeholder="这里输入密码" />
									<span style="color:red;">若不修改密码请留空！</span>
								</td>
							</tr>
							<tr>
								<td class="x3 text-right line-height"><span>确认密码：</span></td>
								<td class="x9">
									<input type="password" name="repassword"  class="input input-auto" placeholder="再次输入密码" />
								</td>
							</tr><?php endif; ?>
							<tr>
								<td class="x3 text-right line-height"></td>
								<td class="x9 text-left">
									<a class="button border-main" href="javascript:save();">保存</a>
								</td>
							</tr>
						</tbody>
					</table>
			    </div>
		  	</div>
		</form>
		<script type="text/javascript">
			//保存
			function save(){
				$("#formid").submit();
			}
			//删除
			function del(id){
				if(confirm("您确定要删除吗?")){}
			}
			//全选
			$("#checkall").click(function(){ 
			  	$("input[name='ckall']").each(function(){
				  	if (this.checked) {
					  	this.checked = false;
				  	}
				  	else {
					  	this.checked = true;
				  	}
			  	});
			})
			//全选删除
			function DelSelect(){
				var Checkbox=false;
				 $("input[name='ckall']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){
					var t=confirm("您确认要删除选中的内容吗？");
					if (t==false) return false; 		
				}
				else{
					alert("请选择您要删除的内容!");
					return false;
				}
			}
		
		</script>
</body>
</html>