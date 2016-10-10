<?php
return array(
    // 配置文件增加设置

    'USER_AUTH_ON'          => true,//  是否需要认证
    'USER_AUTH_TYPE'        => 1,// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'         => 'reality_authId',//  认证识别号,用户认证SESSION标记
    'REQUIRE_AUTH_MODULE'   =>'',		// 默认需要认证模块
    'NOT_AUTH_MODULE'		=>'Public',		// 默认无需认证模块
    'USER_AUTH_GATEWAY'	    =>'/Admin/Public/login',	// 默认认证网关
//    'LINK_IMG_PATH'         =>'/Upload/Link/',   //链接图标保存地址
//    'UPLOAD_PATH'           =>'/Public',



//-----------------------RBAC相关的配置----------------------------------
    'USER_AUTH_MODEL'		=>'User',	// 默认验证数据表模型（找user表）
    'AUTH_PWD_ENCODER'		=>'md5',	// 用户认证密码加密方式
    'NOT_AUTH_ACTION'		=>'',		// 默认无需认证操作
    'REQUIRE_AUTH_ACTION'=>'',		// 默认需要认证操作
    'GUEST_AUTH_ON'          => false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'           =>    0,     // 游客的用户ID
// RBAC_DB_DSN  数据库连接DSN
    'RBAC_ROLE_TABLE'       => 'r_role',//  角色表名称
    'RBAC_USER_TABLE'       => 'r_role_user',//  用户表名称
    'RBAC_ACCESS_TABLE'     => 'r_access',//  权限表名称
    'RBAC_NODE_TABLE'       => 'r_node',//  节点表名称
    'ADMIN_AUTH_KEY'		=>'administrator',
);