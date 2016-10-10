<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends CommonController {
    //角色列表
    public function index(){
        $role = M('Role');
        $count      = $role->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $role->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
//        print_r($list);die;
        $this->display();
    }

    //添加角色
    Public function addRole(){
        if (IS_POST) {
            $role = D('Role');
            if (!$role->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($role->getError());
            }else{
                // 验证通过 可以进行其他数据操作
                $ok = $role->add();
                if ($ok) {
                    $this->success("添加成功！");
                } else {
                    $this->error("添加失败！");
                }
            }
        }

        $this->display();
    }

    //配置权限
    public function access() {
        $rid = isset($_GET['rid']) ? $_GET['rid'] : 0;
        $where['role_id'] = $rid;
        $node = M('Node');
        $arrs_node = $node->field('id,name,title,pid') -> select();
        $access = M('Access');
        $arrs = $access -> where($where) -> getField('node_id', true);
        $arrs_node = node_merge($arrs_node, $arrs);
        $this->rid = $rid;
        $this->assign('list',$arrs_node);
        $this->display();
    }

    //修改权限
    public function setAccess() {
        if (IS_POST){
            $rid = isset($_POST['rid']) ? $_POST['rid'] : 0;
            $where['role_id'] = $rid;
            $access = M('Access');

            //清空原权限
            $access -> where($where) -> delete();

            //组合新权限
            foreach ($_POST['access'] as $v){
                $tmp = explode('_', $v);
                $data[] = array(
                    'role_id' => $rid,
                    'node_id' => $tmp[0],
                    'level' => $tmp[1]
                );
            }

            //插入新权限
            if ($access->addAll($data)) {
                $this->success('修改成功！',U('index'));
            } else {
                $this->error('修改失败！');
            }
        }
    }

    //编辑角色
    public function updateRole() {
        //显示角色信息
        if (IS_GET) {
            $where['id'] = $_GET['id'];
            $role = D('Role');
            $this->list = $role ->where($where) ->find();
        }

        //保存编辑
        if (IS_POST) {
            $role = D('Role');
            if (!$role->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($role->getError());
            }else{
                // 验证通过 可以进行其他数据操作
                if ($role->save()) {
                    $this->success('修改成功');
                }else {
                    $this->error('修改失败');
                }
            }
        }
        $this->display();
    }

    //删除角色
    public function deleteRole() {
        if (IS_GET) {
            $where['id'] = $_GET['id'];
            $where_ru['role_id'] = $_GET['id'];
            $where_a['role_id'] = $_GET['id'];
            $role = M('Role');
            $role_user = M('Role_user');
            $access = M('Access');
            $result = $role ->where($where) ->delete();
            if ($result) {
                $role_user ->where($where_ru) ->delete();
                $access ->where($where_a) ->delete();
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
    }
}