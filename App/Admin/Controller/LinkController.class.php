<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends CommonController {
    /**
     * 链接列表
     */
    public function index(){
        $Link = M('Link');
        $count      = $Link->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(15)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $Link->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
//        print_r($list);die;
        $this->display();
    }

    /**
     * 添加链接
     */
    Public function addLink(){
        if (IS_POST) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     UPLOAD_PATH;
            $upload->savePath  =     LINK_IMG_PATH; // 设置附件上传目录
            $upload->autoSub   =     false;
            $upload->replace   =     true;
            $upload->saveName  =     array('time', '');
            // 上传单个文件
            $info   =   $upload->uploadOne($_FILES['img']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
//                echo $info['savepath'].$info['savename'];
                $_POST['img'] = ltrim(UPLOAD_PATH.LINK_IMG_PATH.$info['savename'], '.');
            }
            $Link = D('Link');
            if (!$Link->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($Link->getError());
            }else{
                // 验证通过 可以进行其他数据操作
                $ok = $Link->add();
                if ($ok) {
                    $this->success("添加成功！");
                } else {
                    $this->error("添加失败！");
                }
            }
        }
        $this->display();
    }

    /**
     * 编辑链接
     */
    public function altLink() {
        //显示角色信息
        if (IS_GET) {
            if( ! isset($_GET['id'])) {
                $this->error('数据错误');
            }
            $where['id'] = (int)$_GET['id'];
            $this->list = M('Link') ->where($where) ->find();
        }
        //保存编辑
        if (isset($_POST['id'])) {
            if ($_FILES['img']) {
                $where['id'] = (int)$_POST['id'];
                $links = M('Link')->where($where)->find();
                if ( ! $links) $this->error('没有此链接！');
                $img = ltrim($links['img'], '/');
                if (file_exists($img)) unlink($img);
                $res = $this->uploadImg();
                if ( ! $res['success']) {
                    $this->error($res['msg']);
                }
                $_POST['img'] = $res['msg'];
            }
            $Link = D('Link');
            if (!$Link->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($Link->getError());
            }else{
                // 验证通过 可以进行其他数据操作
                if ($Link->save()) {
                    $this->success('修改成功');
                }else {
                    $this->error('修改失败');
                }
            }
        }
        $this->display();
    }

    /**
     * 删除链接
     */
    public function delLink() {
        if (IS_GET) {
            if ( ! isset($_GET['id'])) {
                $this->error('数据错误！');
            }
            $where['id'] = (int)$_GET['id'];
            $Link = M('Link');
            $links = $Link->where($where)->find();
            if ( ! $links) $this->error('没有此链接！');
            $img = ltrim($links['img'], '/');
            if (file_exists($img)) unlink($img); //删除图标
            $result = $Link ->where($where) ->delete();
            if ($result) {
                $this->success('删除成功', U('index'));
            } else {
                $this->error('删除失败');
            }
        }
    }

    /**
     * 上传修改的图标
     * @return mixed
     */
    protected function uploadImg() {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     UPLOAD_PATH;
        $upload->savePath  =     LINK_IMG_PATH; // 设置附件上传目录
        $upload->autoSub   =     false;
        $upload->replace   =     true;
        $upload->saveName  =     array('time', '');
        // 上传单个文件
        $info   =   $upload->uploadOne($_FILES['img']);
        if(!$info) {// 上传错误提示错误信息
            $return['success'] = false;
            $return['msg'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $return['success'] = true;
            $return['msg'] = ltrim(UPLOAD_PATH.LINK_IMG_PATH.$info['savename'], '.');
        }
        return $return;
    }
}