<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{
    //用户列表
    public function index(){
        $user = D('UserRelation');
        import('ORG.Util.Page');// 导入分页类
        $count      = $user->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $arrs = $user->field('password',true) -> relation(true) ->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$arrs);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    //添加用户
    Public function addUser(){
        //添加
        if (IS_POST){
            $User = D("User"); // 实例化User对象
            if (!$User->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($User->getError());
            }else{
                // 验证通过 可以进行其他数据操作
                $uid=$User->add();
                if ($uid) {
                    foreach ($_POST['role_id'] as $v){
                        if ($v !='') {
                            $data[]=array(
                                'role_id' => $v,
                                'user_id' => "{$uid}",
                            );
                        }
                    }
                    $Role_user = M('Role_user');
                    $Role_user ->addAll($data);
                    $this->success('添加成功！', U('index'));
                }
            }
        }
        $this->role = M('Role') ->field('id,title') -> select();
        $this->display();
    }

    /*
     * 赋予角色
     */
    public function access() {
        $Role_user = M('Role_user');
        $role = M('Role');
        if (isset($_GET['uid'])) {
            $where['user_id'] = $_GET['uid'];
            $arrs = $Role_user ->where($where)->getField('role_id',true);
            $where_role['status'] ='1';
            $arr_roles = $role ->where($where_role) ->select();
            foreach ($arr_roles as $arr_role) {
                if (in_array($arr_role['id'], $arrs)) {
                    $arr_role['selected'] = '1';
                }
                $list[] = array("id"=>$arr_role['id'],"name"=>$arr_role['name'],"pid"=>$arr_role['pid'],"title"=>$arr_role['id'],"selected"=>$arr_role['selected']);
            }
            $this->uid = $_GET['uid'];
            $this->assign('list',$list);
            $this->display();
        }

        //保存分配角色
        if (IS_POST) {
            $user_id = $_POST['uid'];
            foreach ($_POST['access'] as $k){
                $data[] = array(
                    'role_id' => $k,
                    'user_id' => $user_id,
                );
            }
            $where_role_user['uid'] = $_POST['uid'];
            $Role_user -> where($where_role_user) ->delete();
            $ok = $Role_user ->addAll($data);
            if ($ok) {
                $this->success('分配角色成功');
            }
        }
    }

    //编辑用户
    public function updateUser() {
        $user = D('User');
        if (IS_POST) {
            if (!$user->create()) {
                $this->error($user->getError());
            } else {
                $result = $user ->save();
                if ($result) {
                    $this->success('修改成功');
                } else {
                    $this->error('修改失败');
                }
            }
        }
        $id = isset($_GET['id']) ? (int)$_GET['id'] : C('USER_AUTH_KEY');
        $list = $user->where(array('id' => $id))->find();
        $this->assign('list', $list);
        $this->display();
    }

    //修改密码
    public function altPassword() {
        if (IS_POST) {
            $where['id'] = $_POST['id'];
            $data['password'] = md5($_POST['password']);
            $user = M('User');
            if ($user->where($where)->data($data)->save()) {
                $this->success("修改成功，新密码：".$_POST['password']);
            } else {
                $this->error('修改失败');
            }
        }
    }

    //删除用户
    public function deleteUser() {
        if (IS_GET) {
            $where['id'] = $_GET['id'];
            $where_ru['user_id'] = $_GET['id'];
            $user = M('User');
            $role_user = M('Role_user');
            if ($user ->where($where) ->delete()) {//删除user表中的记录
                $role_user ->where($where_ru) ->delete();//删除role_user表中的记录
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
    }

}
?>