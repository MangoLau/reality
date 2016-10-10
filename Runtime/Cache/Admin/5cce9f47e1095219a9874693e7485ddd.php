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
                        <h5>文章类型添加</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">父类型</label>
                                <div class="controls">
                                    <select name="pCategory" id="pid" class="opt-input">
                                        <?php if(pid == 0): ?><option value="0" selected="selected">大类</option>
                                            <?php else: ?>
                                            <option value="0">大类</option><?php endif; ?>
                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $pid): ?><option value="<?php echo ($vo['id']); ?>" selected="selected"><?php echo ($vo['pad']); echo ($vo['name']); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['pad']); echo ($vo['name']); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">类型名</label>
                                <div class="controls">
                                    <input type="text" id="name" name="name" maxlength="64" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">备注</label>
                                <div class="controls">
                                    <input type="text" id="remark" name="remark" maxlength="64" />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-primary sure">保存</button>
                                <button type="reset" class="btn btn-primary">重置</button>
                                <a class="btn btn-primary" href="<?php echo U('index');?>">返回</a>
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


    <script type="application/javascript">
        $(document).ready(function(){
            $('form .sure').click(function(){
                var _pid = $('#pid').val(),
                        _name = $('#name').val(),
                        _remark = $('#remark').val();
                if(_name.trim() == ''){
                    alert('类型名不能为空！');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "<?php echo U('Category/addCategory');?>",
                    data: {pid:_pid,name:_name,remark:_remark},
                    success: function(result){
                        if(result.success){
                            alert('添加成功！');
                            window.location.href = "<?php echo U('Category/index');?>";
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