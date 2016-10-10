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
                        <h5>导航信息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%;">编号</th>
                                    <th style="width:10%;">导航名</th>
                                    <th style="width:10%;">导航链接</th>
                                    <th style="width:5%;">是否显示</th>
                                    <th style="width:5%;">排序</th>
                                    <th style="width:10%;">创建时间</th>
                                    <th style="width:10%;">修改时间</th>
                                    <th style="width:10%;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><form class="altForm">
                                    <tr>
                                        <td><?php echo ($i); ?></td>
                                        <td><?php echo ($v['pad']); ?><input type="text" name="nav_name" class="nav_name" value="<?php echo ($v['nav_name']); ?>" /></td>
                                        <td><input type="text" name="link" class="link" value="<?php echo ($v['link']); ?>" /></td>
                                        <td>
                                            <?php if($v['display'] == 1): ?><input type="radio" name="display" class="display" value="1" checked />显示
                                                <input type="radio" name="display" class="display" value="0" />隐藏
                                                <?php else: ?>
                                                <input type="radio" name="display" class="display" value="1" />显示
                                                <input type="radio" name="display" class="display" value="0" checked />隐藏<?php endif; ?>
                                        </td>
                                        <td><input type="text" name="sort" class="sort" value="<?php echo ($v['sort']); ?>" /></td>
                                        <td><?php echo ($v['created']); ?></td>
                                        <td><?php echo ($v['modified']); ?></td>
                                        <td>
                                            <a href="<?php echo U('addNav', array('pid' => $v['id']));?>" title="增加子导航"><i class="icon-plus"></i></a>&nbsp;&nbsp;
                                            <a data-id="<?php echo ($v['id']); ?>" class="alter" title="编辑"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                                            <a data-id="<?php echo ($v['id']); ?>" class="delete" title="删除"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    </form><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-th"></i>
                        </span>
                        <h5>类型信息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width:5%;">编号</th>
                                <th style="width:10%;">类型名</th>
                                <th style="width:10%;">链接地址</th>
                                <th style="width:10%;">选择模块</th>
                                <th style="width:10%;">选择方式</th>
                                <th style="width:10%;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($i); ?></td>
                                    <td class="cname" data-name="<?php echo ($vo['name']); ?>"><?php echo ($vo['pad']); echo ($vo['name']); ?></td>
                                    <td>
                                        <input type="text" name="link" class="link" data-link="?cid=<?php echo ($vo['id']); ?>" data-cid="<?php echo ($vo['id']); ?>" readonly="readonly" />
                                    </td>
                                    <td>
                                        <select class="opt-input controller">
                                            <option value="0" data-link="">选择模块</option>
                                            <?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>" data-link="<?php echo ($vo['name']); ?>"><?php echo ($vo['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="opt-input action">
                                            <option value="0" selected="selected">选择方式</option>
                                        </select>
                                    </td>
                                    <td><a class="btn btn-primary add-nav" title="增加导航">增加</i></a>
                                    </td>
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


<script>
    $(function(){
        $('.controller').change(function(){
            var $tr = $(this).parents('tr');
            var _selected = $(this).val();
            var _link = $(this).find("option:selected").attr('data-link');
            var _value = $tr.find('.link').attr('data-link');
            var _html = '<option value="0" data-link="">选择方式</option>';
            if(_selected != 0){
                $tr.find('.link').val(_link+_value);
                $.ajax({
                    url:"<?php echo U('getHomenodeByPid');?>",
                    data: {pid:_selected},
                    dataType: 'json',
                    type: 'GET',
                    success: function (res) {
                        if(res.code == 200 && res.data) {
                            $.each(res.data, function(key,value){
                                _html += '<option value="'+value.id+'" data-link="'+value.name+'">'+value.title+'</option>';
                            });
                            $tr.find('.action').html(_html);
                        } else {
                            alert(res.msg);
                        }
                    }
                });
            } else {
                $tr.find('.link').val('');
            }
        });

        $('.action').change(function(){
            var $tr = $(this).parents('tr'),
                    $controller = $tr.find('.controller'),
                    $action = $tr.find('.action'),
                    _controller_link = $controller.find("option:selected").attr('data-link'),
                    _action_link = $action.find('option:selected').attr('data-link'),
                    _value = $tr.find('.link').attr('data-link');
            if (_action_link == ''){
                $tr.find('.link').val(_controller_link+_value);
            } else {
                $tr.find('.link').val(_controller_link+'/'+_action_link+_value);
            }
        });

        $('.add-nav').click(function(){
            var $tr = $(this).parents('tr'),
                    _link = $tr.find('.link').val(),
                    _cid = $tr.find('.link').attr('data-cid'),
                    _name = $tr.find('.cname').attr('data-name');
            if (_link == '' || _link == 'undefine') {
                alert('链接地址不能为空！');
                return false;
            }
            if (_cid == 'undefine' || _cid == '' || _name == 'undefine' || _name == '') {
                alert('数据错误请刷新或者联系开发人员');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "<?php echo U('addNav');?>",
                dataType: 'json',
                data: {cid:_cid, link:_link, nav_name: _name, type: 1},
                success: function(data){
                    if(data.success == true){
                        alert('新增成功');
                        window.location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });

        $('.alter').click(function(){
            var $tr = $(this).parents('tr');
            var _id = $(this).attr('data-id'),
                    _nav_name = $tr.find('.nav_name').val(),
                    _link = $tr.find('.link').val(),
                    _display = $tr.find('input[name="display"]').val(),
                    _sort = $tr.find('.sort').val();
            if (_nav_name.trim() == '') {
                alert('导航名不能为空');
                return false;
            }
            if (_link.trim() == '') {
                alert('链接不能为空');
                return false;
            }
            $.ajax({
                url: "<?php echo U('altNav');?>",
                type: 'POST',
                dataType: 'json',
                data: {id:_id, nav_name:_nav_name, link:_link, display:_display, sort:_sort},
                success: function(data){
                    if (data.success == true) {
                        alert('修改成功');
                        window.location.reload();
                    } else {
                        alert(data.msg);
                        return false;
                    }
                }
            });
        });

        $('.delete').click(function(){
            if(!confirm('确定删除？')){return false;}
            var _id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo U('delNav');?>",
                type: 'GET',
                dataType: 'json',
                data: {id:_id},
                success: function(data){
                    if (data.success == true) {
                        alert('修改成功');
                        window.location.reload();
                    } else {
                        alert(data.msg);
                        return false;
                    }
                }
            })
        });
    });
</script>

</body>
</html>