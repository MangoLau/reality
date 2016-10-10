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
                        <h5>角色信息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%;">编号</th>
                                    <th style="width:10%;">角色名</th>
                                    <th style="width:15%;">角色简称</th>
                                    <th style="width:5%;">状态</th>
                                    <th style="width:45%;">备注</th>
                                    <th style="width:10%;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>-->
                                    <tr>
                                        <td><?php echo ($v["id"]); ?></td>
                                        <td><?php echo ($v["name"]); ?></td>
                                        <td><?php echo ($v["title"]); ?></td>
                                        <td><?php if($v[status] == 1): ?>开启<i class="icon-ok"></i><?php else: ?>关闭<i class="icon-remove"></i><?php endif; ?></td>
                                        <td><?php echo ($v["remark"]); ?></td>
                                        <td>
                                            <a href="<?php echo U('access', array('rid' => $v['id']));?>" title="配置权限"><i class="icon-wrench"></i></a>&nbsp;&nbsp;
                                            <a href="<?php echo U('updateRole', array('id' => $v['id']));?>" title="编辑"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                                            <a href="<?php echo U('deleteRole', array('id' => $v['id']));?>" title="删除" onclick="if(!confirm('确定删除？')){return false;}"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
                                <tr><td colspan="6"><?php echo ($page); ?></td></tr>
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