<?php
/**
 * Created by PhpStorm.
 * User: mangolau
 * Date: 1/14/16
 * Time: 6:16 PM
 */
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {
    /**
     * 类型列表
     */
    public function index(){
        $Category = M('Category');
        $categoryArr = $Category->select();
        $categoryArr = indent_merge($categoryArr);
        $this->assign('list', $categoryArr);
        $this->display();
    }

    /**
     * 修改类型
     */
    public function altCategory(){
        $Category = D('Category');
        if ($_POST['id']) {
            if( ! trim($_POST['id'])) {
                $result['success'] = false;
                $result['msg'] = '修改数据错误';
                $this->ajaxReturn($result);
            }
            if ( ! $Category->create()){
                $result['code'] = 5002;
                $result['success'] = false;
                $result['msg'] = $Category->getError();
                $this->ajaxReturn($result);
            }
            $result['data'] = $Category->save();
            if($result['data']){
                $result['success'] = true;
                $result['msg'] = '修改成功';
                $this->ajaxReturn($result);
            } else {
                $result['success'] = false;
                $result['msg'] = '数据修改失败';
                $this->ajaxReturn($result);
            }
        }
        if (isset($_GET['id'])) {
            $where['id'] = intval($_GET['id']);
            $categoryArr = $Category->where($where)->find();
            $list = $Category->select();
            $list = indent_merge($list);//print_r($categoryArr);die;
            $this->assign('list', $list);
            $this->assign('category', $categoryArr);
            $this->display();
        }
    }

    /**
     * 增加类型
     */
    public function addCategory() {
        $Category = D('Category');
        if($_POST['name']){
            if ( ! $Category->create()){
                $result['success'] = false;
                $result['msg'] = '数据新增失败';
                $result['fail'] = $Category->getError();
                $this->ajaxReturn($result);
            }
            $result['data'] = $Category->add();
            if ($result['data']) {
                $result['success'] = true;
                $result['msg'] = '新增成功';
                $this->ajaxReturn($result);
            } else {
                $result['success'] = false;
                $result['msg'] = '数据新增失败';
                $result['fail'] = $Category->getError();
                $this->ajaxReturn($result);
            }
        }
        $categoryArr = $Category->select();
        $categoryArr = indent_merge($categoryArr);
        $pid = $_GET['pid'] ? intval($_GET['pid']) : 0;
        $this->assign('pid', $pid);
        $this->assign('list', $categoryArr);
        $this->display();
    }

    /**
     * 删除类型
     */
    public function delCategory(){
        $Category = D('Category');
        if(!trim($_GET['id'])){
            $result['success'] = false;
            $result['msg'] = '删除数据错误';
            $this->ajaxReturn($result);
        }
        $id = (int)$_GET['id'];
        $childs = $Category->where(array('pid'=>$id))->select();
        if (isset($childs) && $childs != null) {
            $result['success'] = false;
            $result['msg'] = '此类型还有子类型！';
            $this->ajaxReturn($result);
        }
        $result['data'] = $Category->delete($id);
        if($result['data']){
            $result['code'] = 200;
            $result['success'] = true;
            $result['msg'] = '删除成功';
            $this->ajaxReturn($result);
        } else {
            $result['code'] = 5002;
            $result['success'] = false;
            $result['msg'] = '删除失败';
            $this->ajaxReturn($result);
        }
    }
}
