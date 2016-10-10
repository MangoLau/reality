<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>

    <title><?php echo ((isset($list['title']) && ($list['title'] !== ""))?($list['title']):"MangoLau's Blog"); ?></title>
    <meta name="keyword" content="<?php echo ((isset($list['keyword']) && ($list['keyword'] !== ""))?($list['keyword']):'MangoLau Blog'); ?>" />
    <meta name="description" content="<?php echo ((isset($list['description']) && ($list['description'] !== ""))?($list['description']):'MangoLau Blog'); ?>" />
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="/reality/Public/Index/css/style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="header"></div>
<div id="wrap">
    <!-- 首页内容左侧 start -->
    <div id="left">
        <h1><?php echo ($list['title']); ?></h1>
        <span><?php echo ($list['created']); ?></span>
        <div class="content">
            <?php echo ($list['content']); ?>
        </div>
    </div>
    <!-- 首页内容左侧 end -->
    <!-- 首页内容右侧 start -->
    <!-- 首页内容右侧 start -->
<div id="right">
    <!-- 新发表文章 start -->
    <div class="wrap-link">
        <h2>最新文章</h2>
        <ul>
            <?php if(is_array($newest)): $i = 0; $__LIST__ = $newest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Content/baseList',array('id'=>$v['id']));?>" title="<?php echo ($v['title']); ?>"><?php echo ($v['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <!-- 新发表文章 end -->
    <!-- 热点文章 start -->
    <div class="wrap-link">
        <h2>最热文章</h2>
        <ul>
            <?php if(is_array($hotest)): $i = 0; $__LIST__ = $hotest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Content/baseList',array('id'=>$v['id']));?>" title="<?php echo ($v['title']); ?>"><?php echo ($v['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <!-- 热点文章 end -->
    <!-- 随机文章 start -->
    <div class="wrap-link">
        <h2>随机文章</h2>
        <ul>
            <?php if(is_array($rands)): $i = 0; $__LIST__ = $rands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Content/baseList',array('id'=>$v['id']));?>" title="<?php echo ($v['title']); ?>"><?php echo ($v['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <!-- 随机文章 end -->
</div>
<!-- 首页内容右侧 end -->
    <!-- 首页内容右侧 end -->
</div>

<div id="footer">
    <p class="copyright">copyright 2016-2016</p>
</div>



<script src="/reality/Public/Admin/js/jquery.min.js"></script>


</body>
</html>