<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <meta name="renderer" content="webkit">
	    <title>新增分类</title>  
	    <link rel="stylesheet" href="/dc/Public/Css/pintuer.css">
	    <link rel="stylesheet" href="/dc/Public/Css/admin.css">
	    <script src="/dc/Public/Js/js/jquery.js"></script>
	    <script src="/dc/Public/Js/js/pintuer.js"></script>  
	    <script type="text/javascript" src="/dc/Public/Js/js/layer/layer.js" ></script>
	    <script type="text/javascript" src="/dc/Public/Js/jedate/jedate.js" ></script>
	</head>
	<body>
<!-- 	<tr>  
    <td class="left"><label>上级分类：</label></td>  
    <td>  
        <select name="pid">  
            <option value="0">顶级分类</option>  
            <?php if(is_array($row)): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val['html']); echo ($val["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>  
        </select>  
    </td>  
</tr>   -->


		<form id="formid" method="POST" action="/dc/Home/Admin/Admin/addcategory?id=24" class="ttb">
		<input type="hidden" name="id" value="<?php echo ($cat["id"]); ?>" />
		  	<div class="panel admin-panel">
			    <div class="panel-head"><strong class="icon-reorder"> <?php echo ($cat?"编辑分类":"新增分类"); ?></strong></div>
			    <div class="table-responsive">
				    <table class="table notableborder">
						<tbody>
							<tr>
								<td class="x3 text-right line-height"><span>父级：</span></td>
								<td class="x9">
									 <select name="pid" class="input input-auto">  
							            <option value="0">顶级分类</option>  
							            <?php if(is_array($row)): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>" 
						                <?php if($cat["pid"] == $val['id']): ?>selected="selected"<?php endif; ?>
						                
						                ><?php echo ($val['html']); echo ($val["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>  
							        </select>  
								</td>
							</tr>
							<tr>
								<td class="x3 text-right line-height"><span>级别：</span></td>
								<td class="x9"><input type="text" name="level" value="<?php echo ($cat["level"]); ?>" class="input input-auto" placeholder="这里输入级别" /></td>
							</tr>
							<tr>
								<td class="x3 text-right line-height"><span>类别名称：</span></td>
								<td class="x9"><input type="text" name="name" value="<?php echo ($cat["name"]); ?>" class="input input-auto" placeholder="这里输入类别名称" /></td>
							</tr>
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