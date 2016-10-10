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
							<h5>节点列表</h5>
						</div>
						<div class="widget-content nopadding" id="wrap">
                            <a href="<?php echo U('addHomenode');?>" class="btn btn-primary btn-large">添加控制器</a>
							<!-- <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?>-->
								<div class="app">
									<p>
										<strong><?php echo ($app["title"]); ?></strong>
										[<a href="<?php echo U('addHomenode', array('pid' => $app['id']));?>">添加方法</a>]
										[<a href="<?php echo U('altHomenode', array('id' => $app['id']));?>">修改</a>]
										[<a href="<?php echo U('delHomenode', array('id' => $app['id']));?>" onclick="if(!confirm('确认删除？')){return false;}">删除</a>]
									</p>
									<!-- <?php if(is_array($app["child"])): $i = 0; $__LIST__ = $app["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?>-->
										<dl>
											<dt>
												<strong><?php echo ($action["title"]); ?></strong>
												[<a href="<?php echo U('altHomenode', array('id' => $action['id']));?>">修改</a>]
												[<a href="<?php echo U('delHomenode', array('id' => $action['id']));?>" onclick="if(!confirm('确认删除？')){return false;}">删除</a>]
											</dt>
										</dl>
									<!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
								</div>
							<!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
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