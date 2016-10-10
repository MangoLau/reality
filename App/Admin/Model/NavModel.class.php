<?php
namespace Admin\Model;
use Think\Model;
class NavModel extends Model {
	protected $_validate = array(
		array('nav_name','require','导航名必须！'), //默认情况下用正则进行验证
		array('nav_name','/.{0,32}/','导航名不得多于32个字符！',0,'regex',1),
	 	array('name','','导航名已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
		array('link','require','链接地址必须！'), //默认情况下用正则进行验证
		array('link','/.{0,32}/','链接地址不得多于32个字符！',0,'regex',1),
	);
	
	protected $_auto = array (
        array('display','1',self::MODEL_INSERT),
        array('created','datetime',self::MODEL_INSERT,'callback'),
        array('modified','datetime',self::MODEL_UPDATE,'callback'),
	);

    /**
     * @return bool|string
     * 当前时间
     */
    protected function datetime(){
        return date('Y-m-d H:i:s');
    }
}