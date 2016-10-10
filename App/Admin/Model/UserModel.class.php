<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {
	protected $_validate = array(
		array('username','require','用户账号必须！'), //默认情况下用正则进行验证
		array('username','/.{0,25}/','用户账号不得多于25个字符！',0,'regex',1),
	 	array('username','','用户账号已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
		array('nickname','require','用户昵称必须！'), //默认情况下用正则进行验证
		array('nickname','/.{0,50}/','昵称不得多于50个字符！',0,'regex',1),
		array('password','require','密码必须！'), //默认情况下用正则进行验证
        array('password','/.{0,50}/','密码不得多于50个字符！',0,'regex',1),
		array('department_id','require','所属部门必须！'), //默认情况下用正则进行验证
        array('position_id','require','所任职位必须！'), //默认情况下用正则进行验证
		array('email','require','邮箱必须！'), //默认情况下用正则进行验证
		array('email','email','邮箱格式错误！'), //默认情况下用正则进行验证
        array('email','','邮箱已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
		array('phone','require','手机号码必须！'), //默认情况下用正则进行验证
		array('phone','/^[1][3758]\d{9}$/','手机号码有错！',0,'regex',1),
	);
	
	protected $_auto = array (
		array('status','1'),  // 新增的时候把status字段设置为1
		array('login_count','0'),  // 新增的时候把login_count字段设置为0
		array('password','md5',Model:: MODEL_INSERT,'function') , // 对password字段在新增的时候使md5函数处理
		array('register_time','time',Model:: MODEL_INSERT,'function'),
		array('last_login_time','time',Model::MODEL_BOTH,'function'),
		array('last_login_ip','get_client_ip',Model::MODEL_BOTH,'function'),
	);
}