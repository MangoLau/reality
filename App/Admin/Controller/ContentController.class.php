<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/14 0014
 * Time: 17:10
 */
namespace Admin\Controller;
use Think\Controller;
class ContentController extends CommonController {
    /**
     * 已审核文章列表
     **/
    public function index() {
        $Content = M('Content');
        $where['status'] = 1;
        $count = $Content->where($where)->count();
        $Page = new \Think\Page($count, 12);
        $show = $Page->show();
        $list = $Content->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $catArr = M('Category')->select();
        $catArr = indent_merge($catArr);
        $this->assign('status', 1);
        $this->assign('cats', $catArr);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display(); // 输出模板
    }

    /**
     * 未审核文章列表
     **/
    public function noAuditList() {
        $Content = M('Content');
        $where['status'] = 0;
        $count = $Content->where($where)->count();
        $Page = new \Think\Page($count, 12);
        $show = $Page->show();
        $list = $Content->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $catArr = M('Category')->select();
        $catArr = indent_merge($catArr);
        $this->assign('status', 0);
        $this->assign('cats', $catArr);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display('index'); // 输出模板
    }

    /**
     * 文章添加
     */
    public function addContent() {
        if (isset($_POST['title'])){
            $Content = D('Content');
            if (!$Content->create()){     // 如果创建失败 表示验证没有通过 输出错误提示信息
                $return['success'] = false;
                $return['code'] = 5001;
                $return['msg'] = $Content->getError();
                $this->ajaxReturn($return);die;
            }else{     // 验证通过 可以进行其他数据操作
                $ok = $Content->add();
                if ($ok) {
                    $return['success'] = true;
                    $return['code'] = 200;
                    $return['msg'] = '添加成功！';
                    $this->ajaxReturn($return);die;
                } else {
                    $return['success'] = false;
                    $return['code'] = 5002;
                    $return['msg'] = '添加失败！';
                    $this->ajaxReturn($return);die;
                }
            }
        }
        $categoryArr = D('Category')->getCates();
        $this->assign('categoryArr', $categoryArr);
        $this->assign('captionTitle', '文章列表');
        $this->display();
    }

    /**
     * 文章修改
     */
    public function altContent() {
        if (isset($_POST['id']) && isset($_POST['title'])) {
            $Content = D('Content');
            if (!$Content->create()){     // 如果创建失败 表示验证没有通过 输出错误提示信息
                $return['success'] = false;
                $return['code'] = 5001;
                $return['msg'] = $Content->getError();
                $this->ajaxReturn($return);die;
            }else{     // 验证通过 可以进行其他数据操作
                $ok = $Content->save();
                if ($ok) {
                    $return['success'] = true;
                    $return['code'] = 200;
                    $return['msg'] = '更新成功！';
                    $this->ajaxReturn($return);die;
                } else {
                    $return['success'] = false;
                    $return['code'] = 5002;
                    $return['msg'] = '更新失败！';
                    $this->ajaxReturn($return);die;
                }
            }
        }
        //显示修改页面
        if (isset($_GET['aid'])) {
            $where['id'] = intval($_GET['aid']);
            $list = M('Content')->where($where)->find();
            if ( ! $list) {
                $this->error('没有此文章');
            }
            $cates = D('Category')->listCates($list['cid']);
            $this->assign('cates', $cates);
            $this->assign('list', $list);
            $this->display();die;
        }
    }

    /**
     * 文章删除
     */
    public function delContent() {
        if (isset($_GET['id'])) {
            $where['id'] = intval($_GET['id']);
            $Content = M('Content');
            $ok = $Content->where($where)->delete();
            if ($ok) {
                $return['success'] = true;
                $return['code'] = 200;
                $return['msg'] = '删除成功！';
                $this->ajaxReturn($return);die;
            } else {
                $return['success'] = false;
                $return['code'] = 5002;
                $return['msg'] = '删除失败！';
                $this->ajaxReturn($return);die;
            }
        } else {
            $return['success'] = false;
            $return['code'] = 5003;
            $return['msg'] = '数据错误！';
            $this->ajaxReturn($return);die;
        }
    }

    /**
     * 搜索文章
     */
    public function searchContents() {
        $Content = M('Content');
        if (isset($_GET['cid']) && !empty($_GET['cid'])) {
            $where['cid'] = (int)$_GET['cid'];
            $this->assign('cid', (int)($_GET['cid']));
        }
        if (isset($_GET['status']) && !empty($_GET['status']))
            $where['status'] = (int)$_POST['status'];
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $where['title'] = array('like', '%'.$_GET['title'].'%');
            $this->assign('title', $_GET['title']);
        }

        $count = $Content->where($where)->count();
        $Page = new \Think\Page($count, 12);
        $show = $Page->show();
        $list = $Content->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $catArr = M('Category')->select();
        $catArr = indent_merge($catArr);
        $this->assign('status', 1);
        $this->assign('cats', $catArr);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display('index'); // 输出模板
    }

    public function audit() {
        if ( ! isset($_POST['id']) || empty($_POST['id'])) {
            $return['success'] = false;
            $return['code'] = 3001;
            $return['msg'] = '数据错误';
            $this->ajaxReturn($return);
        }
        $_POST['id'] = (int)$_POST['id'];
        $Content = M('Content');
        $res = $Content->where(array('id'=>$_POST['id']))->data(array('status'=>1))->save();
        if ($res) {
            $return['success'] = true;
            $return['code'] = 200;
            $return['msg'] = '审核成功';
            $this->ajaxReturn($return);
        } else {
            $return['success'] = false;
            $return['code'] = 3003;
            $return['msg'] = $Content->getError();
            $this->ajaxReturn($return);
        }
    }

}