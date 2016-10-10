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
                        <h5>文章搜索</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal fom" action="<?php echo U('searchContents');?>" method="get">
                            <div class="control-group">
                                <label class="control-label">类型</label>
                                <div class="controls">
                                    <input type="hidden" value="<?php echo ($status); ?>" name="status" />
                                    <select name="cid" id="cid">
                                        <option value="0">请选择类别</option>
                                        <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $cid): ?><option value="<?php echo ($vo['id']); ?>" selected><?php echo ($vo['pad']); echo ($vo['name']); ?>
                                                <?php else: ?>
                                                <option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['pad']); echo ($vo['name']); endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">文章标题</label>
                                <div class="controls">
                                    <input type="text" id="title" name="title" value="<?php echo ($title); ?>" maxlength="64" />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-primary sure">搜索</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-th"></i>
                        </span>
                        <h5>文章列表</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>文章</th>
                                <th>所属类型</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($key+1); ?></td>
                                    <td><a href="javascript:void(0);" class="catName" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["title"]); ?></a></td>
                                    <td><span class="catName"><?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($v['id'] == $vo['cid']): echo ($v['name']); endif; endforeach; endif; else: echo "" ;endif; ?></span></td>
                                    <td><span class="catName"><?php echo ($vo["created"]); ?></span></td>
                                    <td><span class="catName"><?php echo ($vo["modified"]); ?></span></td>
                                    <td>
                                        <a title="修改" href="<?php echo U('altContent', array('aid' => $vo['id']));?>"><i class="icon-pencil"></i></a>
                                        <?php if($vo['status'] == 0): ?><a title="审核" href="javascript:void (0);" data-id="<?php echo ($vo['id']); ?>" class="audit" ><i class="icon-ok"></i></a><?php endif; ?>
                                        <a class="del" href="javascript:void(0);" data-id="<?php echo ($vo['id']); ?>" title="删除" data-title="<?php echo ($vo['title']); ?>"><i class="icon-trash"></i></a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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


    <script type="application/javascript">
        $(function () {
            //删除
            $('.del').click(function(){
                var _id = $(this).attr('data-id'),_title = $(this).attr('data-title');
                if (!confirm('确定删除《'+_title+'》？')) {
                    return false;
                }
                $.ajax({
                    type: "GET",
                    url: "<?php echo U('Content/delContent');?>",
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

            $('#title').keydown(function(e) {
                //回车事件
                if (e.which == 13) {
                    $('.sure').click();
                }
            });

            $('.sure').click(function(){
                fomSubmit();
            });

            function fomSubmit() {
                var _cid = $('#cid').val(),
                        _title = $.trim($('#title').val());
                if (_cid==0 && _title=='') {
                    alert('不能缺少搜索条件');
                    return false;
                } else {
                    window.location.href = "<?php echo U('searchContents');?>"+'?cid='+_cid+'&title='+_title;
                }
            }

            $('.audit').click(function(){
                var _id = $(this).attr('data-id');
                $.ajax({
                    url: "<?php echo U(audit);?>",
                    type: "POST",
                    dataType: 'json',
                    data: {id: _id},
                    success: function(data) {
                        if (data.success) {
                            alert(data.msg);
                            window.location.href = "<?php echo U('index');?>";
                        } else {
                            alert(data.msg);
                            return false
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>