<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_FILTER'        =>  'trim,htmlspecialchars', // 默认参数过滤方法 用于I函数...

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'reality',   // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'r_',    // 数据库表前缀
//    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  true, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', // 指定从服务器序号

    /* 错误设置 */
    'ERROR_MESSAGE'         =>  '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'            =>  '',	// 错误定向页面
    'SHOW_ERROR_MSG'        =>  true,    // 显示错误信息
    'TRACE_MAX_RECORD'      =>  100,    // 每个级别的错误信息 最大记录数
    'SHOW_PAGE_TRACE'       =>  true,

	/* UEditor资源保存路径设置 */
	'IMAGE_URL_PREFIX'		=> '', //图片访问路径前缀
	'IMAGE_PATH_FORMAT'		=> '/Upload/image/{yyyy}/{mm}/{dd}/{time}{rand:6}', //上传图片配置项,上传保存路径,可以自定义保存路径和文件名格式
	'SCRAWL_PATH_FROMAT'	=> '/Upload/image/{yyyy}/{mm}/{dd}/{time}{rand:6}', //涂鸦图片上传配置项,上传保存路径,可以自定义保存路径和文件名格式
	"SNAPSCREEN_PATH_FORMAT"=> "/Upload/image/{yyyy}/{mm}/{dd}/{time}{rand:6}", // 截图工具上传,上传保存路径,可以自定义保存路径和文件名格式
	"CATCHER_PATH_FORMAT"	=> "/Upload/image/{yyyy}/{mm}/{dd}/{time}{rand:6}", // 抓取远程图片配置,上传保存路径,可以自定义保存路径和文件名格式
	"VIDEO_PATH_FORMAT"		=> "/Upload/video/{yyyy}/{mm}/{dd}/{time}{rand:6}", // 上传视频配置,上传保存路径,可以自定义保存路径和文件名格式
	"FILE_PATH_FORMAT"		=> "/Upload/file/{yyyy}/{mm}/{dd}/{time}{rand:6}",  //上传文件配置,上传保存路径,可以自定义保存路径和文件名格式
);