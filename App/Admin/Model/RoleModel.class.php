<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model{
	protected $_validate = array(
		array('name','require','角色名必须！'), //默认情况下用正则进行验证
		array('name','require','角色简称必须！'), //默认情况下用正则进行验证
		array('status','require','状态必须！'), //默认情况下用正则进行验证
		array('name','','角色名已经存在！',0,'unique',Model:: MODEL_INSERT), // 在新增的时候验证name字段是否唯一
	);
}
?>