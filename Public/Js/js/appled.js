	
		var deleteurl=$("#deleteurl").val();
			//删除
			/* function del(id){
				if(confirm("您确定要删除吗?")){}
			} */
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
			/* function DelSelect(){
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
			} */
			
			//批量删除
	 		function deleteall(id){
	 			var ids = getSelectIds();
		 		if(id!=null&&id!=""){
		 			ids += id + ";";
		 		}
		 			
	 			//alert(ids);
	 		
	 			if (ids.length > 0) {
	 				 if (window.confirm("你确认要删除所选吗?")) { 
	 					$.ajax({
	 						type : "post",
	 						url : deleteurl,
/* 	 						url : "__APP__/Home/Admin/Admin/deleteuser", */
	 						data:{ids:ids},
	 						timeout : 10000,//服务器响应时间太长   会执行。。
	 						success : function(msg) {
	 							//alert(msg);
	 							if(msg.status=='1'){
	 								alert(msg.msg);
	 								location.href=location.href;
	 							}else{
	 								alert(msg.msg);
	 								location.href=location.href;
	 							}
	 						}
	 					});
	 			 	}
	 			} else {
	 				alert("请先选择对象！");
	 			}
	 		}
			
			function getSelectIds() {
				var objs = document.getElementsByName("ckall");
				var objslength = objs.length;
				var ids = "";
				for ( var i = 0; i < objslength; i++) {
					if (objs[i].checked) {
						ids += objs[i].value + ";";
					}
				}
				return ids;
			}
