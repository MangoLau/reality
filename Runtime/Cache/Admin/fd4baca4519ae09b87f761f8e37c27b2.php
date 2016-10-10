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
                        <h5>类型列表</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>类型名</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($i); ?></td>
                                    <td><span class="catName"><?php echo ($vo["pad"]); echo ($vo["name"]); ?></span></td>
                                    <td>
                                        <a href="<?php echo U('altCategory', array('id' => $vo['id']));?>" title="修改" data-id="<?php echo ($vo['id']); ?>"><i class="icon-pencil"></i></a>
                                        <a class="act add" href="<?php echo U('addCategory', array('pid' => $vo['id']));?>" title="添加子类" data-id="<?php echo ($vo['id']); ?>"><i class="icon-plus"></i></a>
                                        <a class="act del" href="javascript:void(0);" title="删除" data-name="<?php echo ($vo['name']); ?>" data-id="<?php echo ($vo['id']); ?>"><i class="icon-trash"></i></a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr><td colspan="3"><?php echo ($page); ?></td></tr>
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


    <script type="application/javascript">
        $(document).ready(function(){
            $('.del').on('click',function(){
                var _id = $(this).attr('data-id'),
                        _name = $(this).attr('data-name');
                if (!confirm('确定删除《'+_name+'》？')) {
                    return false;
                }
                $.ajax({
                    type: "GET",
                    url: "<?php echo U('Category/delCategory');?>",
                    data: {id:_id},
                    success: function(result){
                        if(result.success){
                            alert('删除成功！');
                            window.location.reload();
                        } else {
                            alert(result.msg);
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>