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
						<h5>节点编辑</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="<?php echo U('updateNode');?>" method="post" class="form-horizontal">
							<div class="control-group">
								<label class="control-label">名称</label>
								<div class="controls">
									<input type="text" name="name" value="<?php echo ($list['name']); ?>" style="height:30px;"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">描述</label>
								<div class="controls">
									<input type="text" name="title" value="<?php echo ($list['title']); ?>" style="height:30px;"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">是否开启</label>
								<div class="controls">
									<select name="status">
										<?php if($list[status] == 1): ?><option value="1" selected="selected">开启
											<option value="0">关闭
										<?php else: ?>
											<option value="1">开启
											<option value="0" selected="selected">关闭<?php endif; ?>
									</select>
								</div>
							</div>
                            <div class="control-group">
                                <label class="control-label">是否显示</label>
                                <div class="controls">
                                    <select name="display">
                                        <?php if($list['display'] == 1): ?><option value="1" selected="selected">显示
                                        <option value="0">隐藏
                                        <?php else: ?>
                                        <option value="1">显示
                                        <option value="0" selected="selected">隐藏<?php endif; ?>
                                    </select>
                                </div>
                            </div>
							<div class="control-group">
								<label class="control-label">排序</label>
								<div class="controls">
									<input name="sort" value="<?php echo ($list[sort]); ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">备注</label>
								<div class="controls">
									<textarea name="remark"><?php echo ($list[remark]); ?></textarea>
								</div>
							</div>
							<div class="form-actions">
								<input type="hidden" name="id" value="<?php echo ($list[id]); ?>"/>
								<input type="hidden" name="pid" value="<?php echo ($list[pid]); ?>"/>
								<input type="hidden" name="level" value="<?php echo ($list[level]); ?>"/>
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


</body>
</html>