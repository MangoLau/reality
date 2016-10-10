<?php
/**
 * Created by PhpStorm.
 * User: MangoLau
 * Date: 2016/4/21 0021
 * Time: 15:00
 */

namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index() {
        $Content = M('Content');
        // 最新的10篇文章
        $newestContent = $Content->where(array('status'=>1))->order('created desc')->limit(10)->select();
        // 最热的10篇文章
        $hotestContent = $Content->field('id,title')->where(array('status'=>1))->order('hits desc,created desc')->limit(10)->select();
        // 随机文章十篇
        $randSql = 'SELECT a.`id`,a.`title` FROM `'.C('DB_PREFIX').'content` a join (
    SELECT ROUND(
        RAND() * ((SELECT MAX(id) FROM `'.C('DB_PREFIX').'content` WHERE status=1)-
        (SELECT MIN(id)FROM `'.C('DB_PREFIX').'content` WHERE status=1))+
        (SELECT MIN(id) FROM `'.C('DB_PREFIX').'content` WHERE status=1)
        ) AS id
    ) AS b WHERE a.id >= b.id ORDER BY a.id LIMIT 10;';

        $randContent = $Content->query($randSql);
        $this->assign('rands', $randContent);
        $this->assign('newest', $newestContent);
        $this->assign('hotest', $hotestContent);
        $this->display();
    }
}