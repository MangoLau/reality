<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<!-- container-fluid -->
<head>
    <title>登录</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/reality/Public/Admin/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/reality/Public/Admin/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="/reality/Public/Admin/css/unicorn.main.css" />
        <link rel="stylesheet" href="/reality/Public/Admin/css/unicorn.grey.css" class="skin-color" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <div style="width: 600px;height: 100%;margin: 200px auto;">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
						<span class="icon">
							<i class="icon-th"></i>
						</span>
                            <h5>登录</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="<?php echo U('login');?>" method="post" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">用户名：</label>
                                    <div class="controls">
                                        <input type="text" name="username" id="username" maxlength="25"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">密码</label>
                                    <div class="controls">
                                        <input type="password" name="password" id="password" autocomplete="off" maxlength="32" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">验证码：</label>
                                    <div class="controls">
                                        <input type="text" name="verify" id="verify" maxlength="4" />
                                        <img src="<?php echo U('verify');?>" alt="验证码" id="verify-img" title="看不清？点击换另一张"
                                             onclick="RefreshCode(this)" style="cursor:pointer;"/>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="button" class="btn btn-primary sure">登录</button>
                                    <button type="reset" class="btn btn-primary">重置</button>
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
    <script>
        function RefreshCode(obj){
            obj.src = obj.src + "?code=" + Math.random();
        }
        $(function(){
            $('#verify').keydown(function(e) {
                //回车事件
                if (e.which == 13) {
                    $('.sure').click();
                }
            });
            $('.sure').click(function(){
                var _username = $('#username').val(),
                        _password = $('#password').val(),
                        _verify = $('#verify').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo U('login');?>",
                    data: {username:_username,password:_password,verify:_verify},
                    success: function(data){
                        if (data.success) {
                            window.location.href = "<?php echo U('Admin/Index/index');?>";
                        } else {
                            $('#verify-img').click();
                            alert(data.msg);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>