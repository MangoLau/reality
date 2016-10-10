<?php
namespace Admin\Model;
use Think\Model;
class LinkModel extends Model {
	protected $_validate = array(
		array('link_name','require','链接名必须！'), //默认情况下用正则进行验证
		array('link_name','/.{0,32}/','链接名不得多于32个字符！',0,'regex',1),
        array('href','/.{0,32}/','链接地址不得多于32个字符！',0,'regex',1),
	);
	
	protected $_auto = array (
        array('created','datetime',self::MODEL_INSERT,'callback'),
        array('modified','datetime',self::MODEL_UPDATE,'callback'),
	);

    /**
     * @return bool|string
     * 当前时间
     */
    protected function datetime() {
        return date('Y-m-d H:i:s');
    }
}