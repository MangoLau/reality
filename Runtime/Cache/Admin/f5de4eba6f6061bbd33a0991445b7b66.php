<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<!-- container-fluid -->
<head>
    
        <title>MangoLau Admin</title>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
        <link rel="stylesheet" href="/reality/Public/Admin/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/reality/Public/Admin/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="/reality/Public/Admin/css/unicorn.main.css" />
        <link rel="stylesheet" href="/reality/Public/Admin/css/unicorn.grey.css" class="skin-color" />
    
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

    <div id="content">
        <div id="breadcrumb">
            <a href="<?php echo U('Index/index');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <?php if(is_array($breadcrumb)): $i = 0; $__LIST__ = $breadcrumb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo ($v["link"]); ?>" class="current"><?php echo ($v["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-th"></i>
						</span>
						<h5>用户添加</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="<?php echo U('addUser');?>" method="post" class="form-horizontal">
							<div class="control-group">
								<label class="control-label">用户帐号</label>
								<div class="controls">
									<input type="text" name="username"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">用户昵称</label>
								<div class="controls">
									<input type="text" name="nickname"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">用户密码</label>
								<div class="controls">
									<input type="password" name="password" value="123456"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">手机号码</label>
								<div class="controls">
									<input type="text" name="phone"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">邮箱</label>
								<div class="controls">
									<input type="text" name="email"/>
								</div>
							</div>
							<div class="control-group" id="prents1">
								<label class="control-label">所属角色</label>
								<div class="controls">
									<select name="role_id[]">
										<option value="" selected="selected">请选择角色
										<!-- <?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>-->
										<option value="<?php echo ($v['id']); ?>"><?php echo ($v['title']); ?>
										<!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
									</select>
									<span class="btn" id="add_role">添加一个角色</span>
								</div>
							</div>
							
							<div class="control-group" id="last">
								<label class="control-label">备注</label>
								<div class="controls">
									<textarea name="remark"></textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">保存</button>
								<button type="reset" class="btn btn-primary">重置</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    </div>




    <script src="/reality/Public/Admin/js/jquery.min.js"></script>
    <script src="/reality/Public/Admin/js/jquery.ui.custom.js"></script>
    <script src="/reality/Public/Admin/js/bootstrap.min.js"></script>
    <script src="/reality/Public/Admin/js/unicorn.js"></script>



    <script>
        $(function (){
            $('#add_role').click(function (){
                var obj = $('#prents1').clone();
                obj.find('.btn').remove();
                $('#last').before(obj);
            });
        });
    </script>

</body>
</html>