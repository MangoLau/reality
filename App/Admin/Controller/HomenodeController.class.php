<?php
namespace Admin\Controller;
use Think\Controller;
class HomenodeController extends Controller {

    /**
     * 节点列表
     */
    public function index(){
        $arrs = M('Homenode')->select();
        $arrs = node_merge($arrs);
        $this->assign('list',$arrs);
        $this->display();
    }

    /**
     * 添加节点
     */
    Public function addHomenode(){
        $this->pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
        if (IS_POST) {
            $node = D('Homenode');
            if (!$node->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($node->getError());
            }else{
                // 验证通过 可以进行其他数据操作
                $ok = $node->add();
                if ($ok) {
                    $this->success("添加成功！",U('index'));
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
    public function altHomenode() {
        $where['id'] = (int)$_GET['id'];
        $node = M('Homenode');
        $list = $node ->where($where) ->find();

        if (IS_POST) {
            $node = D("Homenode");
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
    public function delHomenode() {
        $node = M('Homenode');
        $child = $node->where(array('pid'=>(int)$_GET['id']))->select();
        if(isset($child) && $child != null) {
            $this->error('此节点还有子节点，不能删除！');
        }
        $where['id'] = (int)$_GET['id'];
        if ($node->where($where)->delete()) {//删除节点表1、2级
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

}