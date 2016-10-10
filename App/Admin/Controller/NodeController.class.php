<?php
namespace Admin\Controller;
use Think\Controller;
class NodeController extends Controller {

    /**
     * 节点列表
     */
    public function index(){
        $arrs = M('Node')->field('id,name,title,pid')->order('sort')->select();
//        print_r($arrs);die;
        $arrs = node_merge($arrs);
        $this->assign('list',$arrs);
        $this->display();
    }

    /**
     * 添加节点
     */
    Public function addNode(){
        $this->pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
        $this->level = isset($_GET['level']) ? $_GET['level'] : 1;
        switch ($this->level){
            case 1:
                $this->type = '应用';
                break;

            case 2:
                $this->type = '控制器';
                break;

            case 3:
                $this->type = '动作方法';
                break;
        }
        if (IS_POST) {
            $node = D('Node');
            if (!$node->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($node->getError());
            }else{
                // 验证通过 可以进行其他数据操作
                $ok = $node->add();
                if ($ok) {
                    $this->success("添加成功！",U('Node/index'));
                } else {
                    $this->error("添加失败！");
                }
            }
        }

        $this->display();
    }

    /**
     * 编辑节点
     */
    public function updateNode() {
        $where['id'] = (int)$_GET['id'];
        $node = M('Node');
        $list = $node ->where($where) ->find();

        if (IS_POST) {
            $node = D("Node");
            if (!$node->create()) {
                $this->error($node->getError());
            } else {
                if ($node->save()) {
                    $this->success('修改成功');
                } else {
                    $this->error('修改失败');
                }
            }
        }
        $this->assign('list',$list);
        $this->display();
    }

    //删除节点
    /*
     * 删除节点表中id为$_GET['id] 或者pid为$_GET['id']的信息
     * 删除权限表中的node_id为$_GET['id']的信息和拥有子节点的信息
     */
    public function deleteNode() {
        $node = M('Node');
        $access = M('Access');
        $child = $node->where(array('pid'=>(int)$_GET['id']))->select();
        if(isset($child) && $child != null) {
            $this->error('此节点还有子节点，不能删除！');
        }
        $where_node['pid'] = $_GET['id'];
        $where_n['id'] = (int)$_GET['id'];
        $where_n['pid'] = (int)$_GET['id'];
        $where_n['_logic'] = 'OR';
        $where_a['node_id'] = (int)$_GET['id'];
        $arrs = $node ->field('id') ->where($where_node)->select();
        if ($node->where($where_n)->delete()) {//删除节点表1、2级
            $access->where($where_a) ->delete();//删除权限表第1级
            foreach ($arrs as $arr){
                $where_node2['pid'] = $arr['id'];
                $where_a2['node_id'] = $arr['id'];
                $arrs2 = $node ->field('id') ->where($where_node2) ->select();
                $node ->where($where_node2) ->delete();//删除节点表第3级
                $access ->where($where_a2) ->delete();//删除权限表第2级
                foreach ($arrs2 as $arr2){
                    $where_a3['node_id'] = $arr2['id'];
                    $access ->where($where_a3) ->delete();//删除权限表第3级
                }
            }
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

}