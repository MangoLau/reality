<?php
namespace Admin\Model;
use Think\Model;
class HomenodeModel extends Model{
	protected $_validate = array(
		array('name','require','节点名称必须！'), //默认情况下用正则进行验证
		array('title','require','节点描述必须！'), //默认情况下用正则进行验证
	);

/**
 * @var array
 * 自动完成
 */
    protected $_auto = array (
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
?>