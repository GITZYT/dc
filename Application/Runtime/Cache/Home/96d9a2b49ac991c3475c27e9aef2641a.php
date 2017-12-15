<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <meta name="renderer" content="webkit">
	    <title>
	    <?php if($flag == 3): ?>新增文件
	    <?php else: ?>
	    <?php echo ($flag==1?"新增普通文件":"新增红头文件"); endif; ?>
	    </title>  
	   <link rel="stylesheet" href="/dc/Public/Css/pintuer.css">
	    <link rel="stylesheet" href="/dc/Public/Css/admin.css">
	    <script src="/dc/Public/Js/js/jquery.js"></script>
	    <script src="/dc/Public/Js/js/pintuer.js"></script>  
	    <script type="text/javascript" src="/dc/Public/Js/js/layer/layer.js" ></script>
	    <script type="text/javascript" src="/dc/Public/Js/jedate/jedate.js" ></script>
	</head>
	<body>
		<form id="formid" method="POST" action="/dc/Home/Admin/Admin/addfile?id=19&amp;flag=1" enctype="multipart/form-data" class="ttb">
		<input type="hidden" name="id" value="<?php echo ($cat["id"]); ?>" />
		<input type="hidden" name="flag" value="<?php echo ($flag); ?>" />
		  	<div class="panel admin-panel">
			    <div class="panel-head"><strong class="icon-reorder"> 
			    
			  	<?php if($flag == 1): echo ($flag==1&&$cat?"编辑普通文件":"新增普通文件"); ?>
				<?php elseif($flag == 2): ?>
				 <?php echo ($flag==2&&$cat?"编辑红头文件":"新增红头文件"); ?>
				 <?php else: ?>
				 新增文件<?php endif; ?>
			    
			    </strong></div>
			    <div class="table-responsive">
				    <table class="table notableborder">
						<tbody>
							<?php if($flag != 3): ?><tr>
								<td class="x3 text-right line-height"><span>标题：</span></td>
								<td class="x9"><input type="text" name="title" value="<?php echo ($cat["title"]); ?>" class="input input-auto" placeholder="这里输入标题" /></td>
							</tr>
							<tr>
								<td class="x3 text-right line-height"><span>状态：</span></td>
								<td class="x9">
									<select name="isuse"　class="input input-auto">
										<option value=1 <?php if($cat["isuse"] == 1): ?>selected="selected"<?php endif; ?>>启用</option>
										<option value=0 <?php if($cat["isuse"] == 0): ?>selected="selected"<?php endif; ?>>隐藏</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="x3 text-right line-height"><span>分类：</span></td>
								<td class="x9">
									<!-- <select name="type"　class="input input-auto">
										<option value=3 <?php if($cat["type"] == 3): ?>selected="selected"<?php endif; ?>>PPT</option>
										<option value=1 <?php if($cat["type"] == 1): ?>selected="selected"<?php endif; ?>>Excel</option>
										<option value=2 <?php if($cat["type"] == 2): ?>selected="selected"<?php endif; ?>>Word</option>
									</select> -->
									<select name="type" class="input input-auto">  
							          <!--   <option value="0">顶级分类</option>   -->
							            <?php if(is_array($row)): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>" 
						                <?php if($cat["type"] == $val['id']): ?>selected="selected"<?php endif; ?>
						                
						                ><?php echo ($val['html']); echo ($val["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>  
							        </select>  
								
								</td>
							</tr>
							<tr>
								<td class="x3 text-right line-height"><span>图片：</span></td>
								<td class="x9">
									<div class="page-header float-left">
								            <div class="form-group" id="uploadForm" enctype='multipart/form-data'>
								                <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
								                    <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
								                        <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="/dc/Public/Uploads/<?php echo ($cat["picurl"]); ?>" alt="" />
								                    </div>
								                    <input type="hidden" id="pccccc" value="<?php echo ($cat["picurl"]); ?>"/>
								                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
								                    <div>
								                        <span class="btn btn-primary btn-file">
								                            <span class="fileinput-new button border-main">选择文件</span>
								                            <span class="fileinput-exists button border-green">换一张</span>
								                            <input type="file" name="picurl" id="picurl" accept="image/gif,image/jpeg,image/x-png" class="file"/><span style="color:red;" class="mark"></span>
								                        </span>
								                        <a href="javascript:;" class="fileinput-exists button border-red" data-dismiss="fileinput">移除</a>
								                    </div>
								                </div>
								            </div>
								            <!--<button type="button" id="uploadSubmit" class="btn btn-info">提交</button>-->
								    </div>
								    <div class="float-left margin-left text-red">建议尺寸：200px X 200px</div>
								</td>
							</tr>
							
							<tr>
								<td class="x3 text-right line-height"><span>上传文件：</span></td>
								<td class="x9">
									<input onchange="delfi()" type="file" name="fileurl" class="input input-auto" class="file"/><span style="color:red;" class="mark"></span><span id="filename"><?php echo ($cat["fileurl"]); ?></span>
									<?php if(!empty($cat)): ?><input type="hidden" name="fileurl" value="<?php echo ($cat["fileurl"]); ?>" /><?php endif; ?>
								</td>
							</tr>
							 <?php else: ?>
							 <tr>
								<td class="x3 text-right line-height"><span>标题：</span></td>
								<td class="x9"><input type="text" name="title" value="<?php echo ($cat["title"]); ?>" class="input input-auto" placeholder="这里输入标题" /></td>
							</tr>
							 <tr>
								<td class="x3 text-right line-height"><span>分类：</span></td>
								<td class="x9">
									<select name="type"　class="input input-auto">
										<option value=3 <?php if($cat["type"] == 3): ?>selected="selected"<?php endif; ?>>PPT</option>
										<option value=1 <?php if($cat["type"] == 1): ?>selected="selected"<?php endif; ?>>Excel</option>
										<option value=2 <?php if($cat["type"] == 2): ?>selected="selected"<?php endif; ?>>Word</option>
									</select>
								</td>
							</tr>
							 <tr>
								<td class="x3 text-right line-height"><span>上传文件：</span></td>
								<td class="x9">
									<input onchange="delfi()" type="file" name="fileurl" class="input input-auto" class="file" id="file"/><span style="color:red;" class="mark"></span><span id="filename"><?php echo ($cat["fileurl"]); ?></span>
									<?php if(!empty($cat)): ?><input type="hidden" name="fileurl" value="<?php echo ($cat["fileurl"]); ?>" /><?php endif; ?>
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
		
		function delfi(){
			$("#filename").html("");
		}
	
		    $(function () {
				    	
		        $('#uploadSubmit').click(function () {
		            var data = new FormData($('#uploadForm')[0]);
		            $.ajax({
		                url: 'xxx/xxx',
		                type: 'POST',
		                data: data,
		                async: false,
		                cache: false,
		                contentType: false,
		                processData: false,
		                success: function (data) {
		                    console.log(data);
		                    if(data.status){
		                        console.log('upload success');
		                    }else{
		                        console.log(data.message);
		                    }
		                },
		                error: function (data) {
		                    console.log(data.status);
		                }
		            });
		        });
		
		    })
		</script>
		<script type="text/javascript">
			+function ($) { "use strict";

			  var isIE = window.navigator.appName == 'Microsoft Internet Explorer';
			
			  var Fileinput = function (element, options) {
			    this.$element = $(element);
			    
			    this.$input = this.$element.find(':file');
			    if (this.$input.length === 0) return;
			
			    this.name = this.$input.attr('name') || options.name;
			
			    this.$hidden = this.$element.find('input[type=hidden][name="' + this.name + '"]');
			    if (this.$hidden.length === 0) {
			      this.$hidden = $('<input type="hidden">').insertBefore(this.$input)
			    }
			
			    this.$preview = this.$element.find('.fileinput-preview');
			    var height = this.$preview.css('height');
			    if (this.$preview.css('display') !== 'inline' && height !== '0px' && height !== 'none') {
			      this.$preview.css('line-height', height)
			    }
			        
			    this.original = {
			      exists: this.$element.hasClass('fileinput-exists'),
			      preview: this.$preview.html(),
			      hiddenVal: this.$hidden.val()
			    };
			    
			    this.listen()
			  };
			  
			  Fileinput.prototype.listen = function() {
			    this.$input.on('change.bs.fileinput', $.proxy(this.change, this));
			    $(this.$input[0].form).on('reset.bs.fileinput', $.proxy(this.reset, this));
			    
			    this.$element.find('[data-trigger="fileinput"]').on('click.bs.fileinput', $.proxy(this.trigger, this));
			    this.$element.find('[data-dismiss="fileinput"]').on('click.bs.fileinput', $.proxy(this.clear, this))
			  };
			
			  Fileinput.prototype.change = function(e) {
			    var files = e.target.files === undefined ? (e.target && e.target.value ? [{ name: e.target.value.replace(/^.+\\/, '')}] : []) : e.target.files;
			    
			    e.stopPropagation();
			
			    if (files.length === 0) {
			      this.clear();
			      return
			    }
			
			    this.$hidden.val('');
			    this.$hidden.attr('name', '');
			    this.$input.attr('name', this.name);
			
			    var file = files[0];
			
			    if (this.$preview.length > 0 && (typeof file.type !== "undefined" ? file.type.match(/^image\/(gif|png|jpeg)$/) : file.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader !== "undefined") {
			      var reader = new FileReader();
			      var preview = this.$preview;
			      var element = this.$element;
			
			      reader.onload = function(re) {
			        var $img = $('<img>');
			        $img[0].src = re.target.result;
			        files[0].result = re.target.result;
			        
			        element.find('.fileinput-filename').text(file.name);
			        
			        // if parent has max-height, using `(max-)height: 100%` on child doesn't take padding and border into account
			        if (preview.css('max-height') != 'none') $img.css('max-height', parseInt(preview.css('max-height'), 10) - parseInt(preview.css('padding-top'), 10) - parseInt(preview.css('padding-bottom'), 10)  - parseInt(preview.css('border-top'), 10) - parseInt(preview.css('border-bottom'), 10));
			        
			        preview.html($img);
			        element.addClass('fileinput-exists').removeClass('fileinput-new');
			
			        element.trigger('change.bs.fileinput', files)
			      };
			
			      reader.readAsDataURL(file)
			    } else {
			      this.$element.find('.fileinput-filename').text(file.name);
			      this.$preview.text(file.name);
			
			      this.$element.addClass('fileinput-exists').removeClass('fileinput-new');
			      
			      this.$element.trigger('change.bs.fileinput')
			    }
			  };
			
			  Fileinput.prototype.clear = function(e) {
			    if (e) e.preventDefault();
			    
			    this.$hidden.val('');
			    this.$hidden.attr('name', this.name);
			    this.$input.attr('name', '');
			
			    //ie8+ doesn't support changing the value of input with type=file so clone instead
			    if (isIE) { 
			      var inputClone = this.$input.clone(true);
			      this.$input.after(inputClone);
			      this.$input.remove();
			      this.$input = inputClone;
			    } else {
			      this.$input.val('')
			    }
			
			    this.$preview.html('');
			    this.$element.find('.fileinput-filename').text('');
			    this.$element.addClass('fileinput-new').removeClass('fileinput-exists');
			    
			    if (e !== undefined) {
			      this.$input.trigger('change');
			      this.$element.trigger('clear.bs.fileinput')
			    }
			  };
			
			  Fileinput.prototype.reset = function() {
			    this.clear();
			
			    this.$hidden.val(this.original.hiddenVal);
			    this.$preview.html(this.original.preview);
			    this.$element.find('.fileinput-filename').text('');
			
			    if (this.original.exists) this.$element.addClass('fileinput-exists').removeClass('fileinput-new');
			     else this.$element.addClass('fileinput-new').removeClass('fileinput-exists');
			    
			    this.$element.trigger('reset.bs.fileinput')
			  };
			
			  Fileinput.prototype.trigger = function(e) {
			    this.$input.trigger('click');
			    e.preventDefault()
			  };
			
			  var old = $.fn.fileinput;
			  
			  $.fn.fileinput = function (options) {
			    return this.each(function () {
			      var $this = $(this),
			          data = $this.data('bs.fileinput');
			      if (!data) $this.data('bs.fileinput', (data = new Fileinput(this, options)));
			      if (typeof options == 'string') data[options]()
			    })
			  };
			
			  $.fn.fileinput.Constructor = Fileinput;
			
			  $.fn.fileinput.noConflict = function () {
			    $.fn.fileinput = old;
			    return this
			  };
			
			  $(document).on('click.fileinput.data-api', '[data-provides="fileinput"]', function (e) {
			    var $this = $(this);
			    if ($this.data('bs.fileinput')) return;
			    $this.fileinput($this.data());
			      
			    var $target = $(e.target).closest('[data-dismiss="fileinput"],[data-trigger="fileinput"]');
			    if ($target.length > 0) {
			      e.preventDefault();
			      $target.trigger('click.bs.fileinput');
			    }
			  });
			
			}(window.jQuery);
		</script>
		<script type="text/javascript">
		
		//保存
		function save(){
			var filename=$("#filename").html();
			var pic=$("#pccccc").val();
			var file=$(".file").val();
			var ffile=$("#file").val();
			
			if(ffile||file||filename||pic){
				$("#formid").submit();
			}else{
				$(".mark").html("请先上传文件！");
			}
			
		}
		
	
			
		
		</script>
</body>
</html>