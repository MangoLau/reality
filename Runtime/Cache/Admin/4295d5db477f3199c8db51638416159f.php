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
                        <h5>用户信息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%;">id</th>
                                    <th style="width:5%;">用户账号</th>
                                    <th style="width:5%;">登录次数</th>
                                    <th style="width:8%;">注册时间</th>
                                    <th style="width:8%;">上一次登录时间</th>
                                    <th style="width:8%;">上一次登录地址</th>
                                    <th style="width:5%;">手机</th>
                                    <th style="width:5%;">邮箱</th>
                                    <th style="width:5%;">状态</th>
                                    <th style="width:10%;">用户所属组别</th>
                                    <th style="width:8%;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>-->
                                    <tr>
                                        <td><?php echo ($v["id"]); ?></td>
                                        <td><?php echo ($v["username"]); ?></td>
                                        <td><?php echo ($v["login_count"]); ?></td>
                                        <td><?php echo (date('Y-m-d H:i',$v["register_time"])); ?></td>
                                        <td><?php echo (date('Y-m-d H:i',$v["last_login_time"])); ?></td>
                                        <td><?php echo ($v["last_login_ip"]); ?></td>
                                        <td><?php echo ($v["phone"]); ?></td>
                                        <td><?php echo ($v["email"]); ?></td>
                                        <td><?php if($v['status'] == 1): ?><i class="icon-ok" title="开启"></i><?php else: ?><i class="icon-remove" title="关闭"></i><?php endif; ?></td>
                                        <td>
                                            <ul>
                                                <!-- <?php if(is_array($v["role"])): $i = 0; $__LIST__ = $v["role"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>-->
                                                <li><?php echo ($vv["name"]); ?>(<?php echo ($vv["title"]); ?>)</li>
                                                <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="<?php echo U('access', array('uid' => $v['id']));?>" title="赋予角色"><i class="icon-wrench"></i></a>&nbsp;&nbsp;
                                            <a href="<?php echo U('updateUser', array('id' => $v['id']));?>" title="编辑"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                                            <a href="<?php echo U('deleteUser', array('id' => $v['id']));?>" title="删除" onclick="if(!confirm('确定删除？')){return false;}"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
                                <tr><td colspan="13"><?php echo ($page); ?></td></tr>
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