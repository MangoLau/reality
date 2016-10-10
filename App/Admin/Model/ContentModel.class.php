<?php
/**
 * Created by PhpStorm.
 * User: mangolau
 * Date: 2/9/16
 * Time: 11:55 PM
 */
namespace Admin\Model;
use Think\Model;

class ContentModel extends Model{
    /**
     * @var array
     * 自动验证
     */
    protected $_validate = array(
        array('title','require','标题必须！', self::MUST_VALIDATE),
        array('title','1,64','标题长度不能超过64位',self::MUST_VALIDATE,'length',self::MODEL_BOTH),
        array('keyword','0,256','SEO关键词长度不能超过256位',self::MUST_VALIDATE,'length',self::MODEL_BOTH),
        array('description','0,256','SEO描述长度不能超过256位',self::MUST_VALIDATE,'length',self::MODEL_BOTH),
        array('content','require','文章内容必须！',self::MUST_VALIDATE),
//        array('content','1,10000','文章内容长度不能超过10000位',self::MUST_VALIDATE,'length',self::MODEL_BOTH),
    );

    /**
     * @var array
     * 自动完成
     */
    protected $_auto = array (
        array('created','datetime',self::MODEL_INSERT,'callback'),
        array('modified','datetime',self::MODEL_UPDATE,'callback'),
        array('uid','getuser',self::MODEL_INSERT,'callback'),
    );

    /**
     * @return bool|string
     * 当前时间
     */
    protected function datetime(){
        return date('Y-m-d H:i:s');
    }

    /**
     * @return int
     * 用户id
     */
    protected function getuser(){
        return $_SESSION['uid'] ? intval($_SESSION['uid']) : 1;
    }
}

?>