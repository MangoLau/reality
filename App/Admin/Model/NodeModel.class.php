<?php
namespace Admin\Model;
use Think\Model;
class NodeModel extends Model{
	protected $_validate = array(
		array('name','require','节点名称必须！'), //默认情况下用正则进行验证
		array('title','require','节点描述必须！'), //默认情况下用正则进行验证
		array('status','require','状态必须！'), //默认情况下用正则进行验证
	);
}
?>