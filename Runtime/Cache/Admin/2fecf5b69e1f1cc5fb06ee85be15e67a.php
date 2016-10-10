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
                        <h5>链接信息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%;">编号</th>
                                    <th style="width:10%;">链接名</th>
                                    <th style="width:10%;">链接地址</th>
                                    <th style="width:5%;">状态</th>
                                    <th style="width:10%;">链接类型</th>
                                    <th style="width:10%;">图标地址</th>
                                    <th style="width:10%;">创建时间</th>
                                    <th style="width:10%;">修改时间</th>
                                    <th style="width:10%;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($i); ?></td>
                                        <td><?php echo ($v['link_name']); ?></td>
                                        <td><?php echo ($v['href']); ?></td>
                                        <td><?php if($v[status] == 1): ?>开启<i class="icon-ok"></i><?php else: ?>关闭<i class="icon-remove"></i><?php endif; ?></td>
                                        <td><?php if($v['type'] == 1): ?>友情链接<?php else: ?>其他链接<?php endif; ?></td>
                                        <td><?php if($v['img'] != ''): ?><img src="/reality<?php echo ($v['img']); ?>" style="width: 50px;" /><?php endif; ?></td>
                                        <td><?php echo ($v['created']); ?></td>
                                        <td><?php echo ($v['modified']); ?></td>
                                        <td>
                                            <a href="<?php echo U('altLink', array('id' => $v['id']));?>" title="编辑"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                                            <a href="<?php echo U('delLink', array('id' => $v['id']));?>" title="删除" onclick="if(!confirm('确定删除？')){return false;}"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                <tr><td colspan="9"><?php echo ($page); ?></td></tr>
                            </tbody>
                        </table>
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