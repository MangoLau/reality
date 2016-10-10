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
						<h5>密码修改</h5>
					</div>
					<div class="widget-content nopadding">
						<form name="fom1" action="<?php echo U('altPassword');?>" method="post" class="form-horizontal">
							<div class="control-group">
								<label class="control-label">新密码</label>
								<div class="controls">
									<input type="password" name="password" />
								</div>
							</div>
							<div class="form-actions last">
								<input type="hidden" value="<?php echo ($list[id]); ?>" name="id"/>
								<button type="submit" class="btn btn-primary">修改</button>
								<a href="<?php echo U('index');?>" class="btn btn-primary">返回</a>
							</div>
						</form>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-th"></i>
						</span>
						<h5>用户编辑</h5>
					</div>
					<div class="widget-content nopadding">
						<form name="fom2" action="<?php echo U('updateUser');?>" method="post" class="form-horizontal">
							<div class="control-group">
								<label class="control-label">用户帐号</label>
								<div class="controls">
									<input type="text" name="username" value="<?php echo ($list['username']); ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">用户昵称</label>
								<div class="controls">
									<input type="text" name="nickname" value="<?php echo ($list[nickname]); ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">手机号码</label>
								<div class="controls">
									<input type="text" name="phone" value="<?php echo ($list[phone]); ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">邮箱</label>
								<div class="controls">
									<input type="text" name="email" value="<?php echo ($list[email]); ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">备注</label>
								<div class="controls">
									<textarea name="remark"><?php echo ($list['remark']); ?></textarea>
								</div>
							</div>
							<div class="form-actions last">
								<input type="hidden" name="id" value="<?php echo ($list['id']); ?>" />
								<button type="submit" class="btn btn-primary">保存</button>
								<a href="<?php echo U('index');?>" class="btn btn-primary">返回</a>
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
                $('.last').before(obj);
            });
        });
    </script>

</body>
</html>