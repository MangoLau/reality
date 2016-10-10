<?php
/**
 * Created by PhpStorm.
 * User: MangoLau
 * Date: 2016/4/25 0025
 * Time: 14:35
 */
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
    private $verify;
    public function login() {
        if (isset($_POST['username']) && $_POST['username'] != ''){
            if (empty($_POST['password'])) {
                $return['success'] = false;
                $return['msg'] = '密码不能为空';
                $return['code'] = 5001;
                $this->ajaxReturn($return);
            }
            if (empty($_POST['verify'])) {
                $return['success'] = false;
                $return['msg'] = '验证码不能为空';
                $return['code'] = 5002;
                $this->ajaxReturn($return);
            }
            if( ! $this->check_verify($_POST['verify'])) {
                $return['success'] = false;
                $return['msg'] = '验证码错误';
                $return['code'] = 5003;
                $this->ajaxReturn($return);
            }
            //生成认证条件
            $map            =   array();
            // 支持使用绑定帐号登录
            $map['username']	= $_POST['username'];

            $map['status']	=	array('eq',1);
            $authInfo = \Org\Util\Rbac::authenticate($map);
            //使用用户名、密码和状态的方式进行认证
            //修改 FALSE 改为 NULL
            if( NULL === $authInfo) {
                $this->error('帐号不存在或已禁用！');
            }else {
                if($authInfo['password'] != md5($_POST['password'])) {
                    $return['success'] = false;
                    $return['msg'] = '密码错误';
                    $return['code'] = 5004;
                    $this->ajaxReturn($return);
                }
                $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
                $_SESSION['lastLoginTime']		=	$authInfo['last_login_time'];
                $_SESSION['login_count']	=	$authInfo['login_count'];
                if($authInfo['username']=='admin') {
                    $_SESSION['administrator']		=	true;
                }
                //保存登录信息,可用于登陆的时候更新数据
                $User	=	M('User');
                $ip		=	get_client_ip();
                $data = array();
                $data['id']	=	$authInfo['id'];
                $data['last_login_time']	=	time();
                $data['login_count']	=	array('exp','login_count+1');
                $data['last_login_ip']	=	$ip;
                $User->save($data);
                // 缓存访问权限
                \Org\Util\Rbac::saveAccessList();
                $return['success'] = true;
                $return['msg'] = '登录成功';
                $return['code'] = 200;
                $this->ajaxReturn($return);
            }

        }
        $this->display();
    }

    function logout(){
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            echo '<script>top.location.href="'.U('login').'";</script>';
        }else {
            $this->error('已经登出！', U('login'));
        }
    }

    public function verify($length=4,$imageW=0,$imageH=0, $expire=300) {
        $config['length'] = $length;
        $config['imageW'] = $imageW;
        $config['imageH'] = $imageH;
        $config['expire'] = $expire;
        $this->verify = new \Think\Verify($config);
        $this->verify->entry();
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    protected function check_verify($code, $id = '') {
        if ( ! isset($this->verify)) $this->verify = new \Think\Verify();
        return $this->verify->check($code, $id);
    }

}