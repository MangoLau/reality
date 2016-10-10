<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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


<div id="header">
    <h1><a href="<?php echo U('Index/index');?>">MangoLau Admin</a></h1>
</div>

<!--<div id="search">
    <input type="text" placeholder="Search here..." /><button type="submit" class="tip-right" title="Search"><i class="icon-search icon-white"></i></button>
</div>-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse"><a title="" target="_top" href="<?php echo U('Public/logout');?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    </ul>
</div>


<div id="sidebar">
    <a href="<?php echo U('Index/index');?>" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li><a href="<?php echo U('Index/index');?>" target="_top"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
        <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="submenu">
                <a href="#"><i class="icon icon-th-list"></i> <span><?php echo ($vo['title']); ?></span> <span class="label"><?php echo count($vo['child']);?></span></a>
                <ul>
                    <?php if(is_array($vo['child'])): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($vo['name'].'/'.$v['name']);?>" class="link" onclick="return false;" target="_main"><?php echo ($v['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

</div>

<div id="i-content">
    <iframe name="_main" id="_main" style="min-width: 960px;width: 100%;height: 800px;"></iframe>
</div>
<script src="/reality/Public/Admin/js/jquery.min.js"></script>
<script src="/reality/Public/Admin/js/jquery.ui.custom.js"></script>
<script src="/reality/Public/Admin/js/bootstrap.min.js"></script>
<script src="/reality/Public/Admin/js/unicorn.js"></script>
</body>
<script>
	$(function(){
		$('#i-content>iframe').attr("src", "<?php echo U('dashboard');?>");
		$(".link").click(function(){
			var _link = $(this).attr("href");
			$("#_main").attr("src",_link);
		});
	});
</script>
</html>