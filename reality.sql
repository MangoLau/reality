-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-28 18:13:38
-- 服务器版本： 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reality`
--

-- --------------------------------------------------------

--
-- 表的结构 `r_access`
--

DROP TABLE IF EXISTS `r_access`;
CREATE TABLE IF NOT EXISTS `r_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` smallint(6) UNSIGNED NOT NULL,
  `node_id` smallint(6) UNSIGNED NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `r_access`
--

INSERT INTO `r_access` (`id`, `role_id`, `node_id`, `level`, `module`) VALUES
(120, 1, 32, 3, NULL),
(119, 1, 31, 3, NULL),
(118, 1, 30, 3, NULL),
(117, 1, 29, 3, NULL),
(116, 1, 28, 3, NULL),
(115, 1, 27, 3, NULL),
(114, 1, 26, 2, NULL),
(113, 1, 14, 3, NULL),
(112, 1, 13, 2, NULL),
(111, 1, 12, 3, NULL),
(110, 1, 11, 3, NULL),
(109, 1, 10, 3, NULL),
(108, 1, 9, 3, NULL),
(107, 1, 8, 2, NULL),
(106, 1, 7, 3, NULL),
(105, 1, 6, 3, NULL),
(104, 1, 5, 3, NULL),
(103, 1, 4, 3, NULL),
(102, 1, 3, 2, NULL),
(101, 1, 18, 3, NULL),
(100, 1, 17, 3, NULL),
(99, 1, 16, 3, NULL),
(98, 1, 15, 3, NULL),
(97, 1, 2, 2, NULL),
(96, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `r_category`
--

DROP TABLE IF EXISTS `r_category`;
CREATE TABLE IF NOT EXISTS `r_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT '类型名',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `remark` varchar(64) DEFAULT NULL COMMENT '备注',
  `created` datetime DEFAULT NULL COMMENT '新增时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `r_category`
--

INSERT INTO `r_category` (`id`, `name`, `pid`, `remark`, `created`, `modified`) VALUES
(1, '租房信息', 0, '关于租房的信息类目', '2016-10-09 11:29:02', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `r_content`
--

DROP TABLE IF EXISTS `r_content`;
CREATE TABLE IF NOT EXISTS `r_content` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '作者id',
  `title` varchar(64) NOT NULL COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '所属类别',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '文章状态：0，草稿；1已发布（已审核）；2，屏蔽；',
  `istop` tinyint(4) NOT NULL DEFAULT '0' COMMENT '置顶：0，不置顶；1，置顶',
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '创建时间',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '修改时间',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章表';

--
-- 转存表中的数据 `r_content`
--

INSERT INTO `r_content` (`id`, `uid`, `title`, `content`, `cid`, `status`, `istop`, `created`, `modified`, `hits`) VALUES
(1, 1, '测试测试', '&lt;p&gt;白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房白石洲租房&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;/Upload/image/2016/08/04/1470280425124749.png&quot; title=&quot;1475984396174622.png&quot; alt=&quot;1470280425124749.png&quot;/&gt;&lt;/p&gt;', 1, 1, 0, '2016-10-09 11:32:46', '2016-10-09 11:52:07', 0),
(2, 1, '测试2', '&lt;p&gt;&lt;img src=&quot;/Upload/image/2016/10/09/1475986377107536.png&quot; title=&quot;1475986377107536.png&quot; alt=&quot;laizi.png&quot;/&gt;&lt;/p&gt;', 1, 1, 0, '2016-10-09 12:12:58', '2016-10-09 11:52:07', 0);

-- --------------------------------------------------------

--
-- 表的结构 `r_homenode`
--

DROP TABLE IF EXISTS `r_homenode`;
CREATE TABLE IF NOT EXISTS `r_homenode` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `name` varchar(32) NOT NULL COMMENT '节点名，由英文、下划线、数字组成',
  `title` varchar(32) NOT NULL COMMENT '节点称呼',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父节点',
  `created` datetime NOT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='前端节点表，用于导航链接选择显示方法';

--
-- 转存表中的数据 `r_homenode`
--

INSERT INTO `r_homenode` (`id`, `name`, `title`, `pid`, `created`, `modified`) VALUES
(1, 'Content', '文章', 0, '2016-05-03 00:00:00', '2016-05-03 00:00:00'),
(2, 'baseList', '常规展示', 1, '2016-05-03 14:21:31', '2016-05-03 14:26:06');

-- --------------------------------------------------------

--
-- 表的结构 `r_link`
--

DROP TABLE IF EXISTS `r_link`;
CREATE TABLE IF NOT EXISTS `r_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `link_name` varchar(32) NOT NULL COMMENT '链接名',
  `href` varchar(32) NOT NULL COMMENT '链接地址',
  `type` tinyint(4) NOT NULL COMMENT '连接类型：1，友情链接',
  `status` tinyint(4) NOT NULL COMMENT '状态：1，正常；0，屏蔽',
  `img` varchar(32) DEFAULT NULL COMMENT '链接图标',
  `created` datetime NOT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='链接表';

--
-- 转存表中的数据 `r_link`
--

INSERT INTO `r_link` (`id`, `link_name`, `href`, `type`, `status`, `img`, `created`, `modified`) VALUES
(1, '鸿云', 'http://www.homconnect.cn', 1, 1, '/Upload/link/1477640315.png', '2016-10-28 15:38:35', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `r_nav`
--

DROP TABLE IF EXISTS `r_nav`;
CREATE TABLE IF NOT EXISTS `r_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `nav_name` varchar(32) NOT NULL COMMENT '导航名（英文数字或者下划线）',
  `link` varchar(32) NOT NULL COMMENT '链接',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '类型id',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序，由大到小排序',
  `display` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '导航链接类型：0，站外链接；1，站内链接',
  `created` datetime NOT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `r_nav`
--

INSERT INTO `r_nav` (`id`, `nav_name`, `link`, `pid`, `cid`, `sort`, `display`, `type`, `created`, `modified`) VALUES
(20, '租房信息', 'Content/baseList?cid=1', 0, 1, 0, 1, 1, '2016-10-28 15:41:46', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `r_node`
--

DROP TABLE IF EXISTS `r_node`;
CREATE TABLE IF NOT EXISTS `r_node` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `remark` varchar(255) DEFAULT NULL,
  `display` smallint(6) NOT NULL DEFAULT '1',
  `sort` smallint(6) UNSIGNED DEFAULT NULL,
  `pid` smallint(6) UNSIGNED NOT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `r_node`
--

INSERT INTO `r_node` (`id`, `name`, `title`, `group_id`, `status`, `remark`, `display`, `sort`, `pid`, `level`) VALUES
(1, 'Admin', '后台管理', 0, 1, '', 1, 0, 0, 1),
(2, 'Node', '节点管理', 0, 1, '', 1, 0, 1, 2),
(3, 'Category', '类型', 0, 1, '', 1, 0, 1, 2),
(4, 'index', '类型列表', 0, 1, '', 1, 0, 3, 3),
(5, 'altCategory', '修改类型', 0, 1, '', 0, 0, 3, 3),
(6, 'addCategory', '增加类型', 0, 1, '', 1, 0, 3, 3),
(7, 'delCategory', '删除类型', 0, 1, '', 0, 0, 3, 3),
(8, 'Content', '文章', 0, 1, '', 1, 0, 1, 2),
(9, 'index', '已审核文章列表', 0, 1, '', 1, 0, 8, 3),
(10, 'addContent', '文章添加', 0, 1, '', 1, 0, 8, 3),
(11, 'altContent', '文章修改', 0, 1, '', 0, 0, 8, 3),
(12, 'delContent', '文章删除', 0, 1, '', 0, 0, 8, 3),
(13, 'Index', '后台首页', 0, 1, '', 0, 0, 1, 2),
(14, 'index', '首页显示', 0, 1, '', 0, 0, 13, 3),
(15, 'index', '节点列表', 0, 1, '', 1, 0, 2, 3),
(16, 'addNode', '添加节点', 0, 1, '', 0, 0, 2, 3),
(17, 'updateNode', '编辑节点', 0, 1, '', 0, 0, 2, 3),
(18, 'deleteNode', '删除节点', 0, 1, '', 0, 0, 2, 3),
(19, 'Role', '角色', 0, 1, '', 1, 0, 1, 2),
(20, 'index', '角色列表', 0, 1, '', 1, 0, 19, 3),
(21, 'addRole', '添加角色', 0, 1, '', 1, 0, 19, 3),
(22, 'access', '配置权限', 0, 1, '', 0, 0, 19, 3),
(23, 'setAccess', '修改权限', 0, 1, '', 0, 0, 19, 3),
(24, 'updateRole', '编辑角色', 0, 1, '', 0, 0, 19, 3),
(25, 'deleteRole', '删除角色', 0, 1, '', 0, 0, 19, 3),
(26, 'User', '用户', 0, 1, '', 1, 0, 1, 2),
(27, 'index', '用户列表', 0, 1, '', 1, 0, 26, 3),
(28, 'addUser', '添加用户', 0, 1, '', 1, 0, 26, 3),
(29, 'access', '赋予角色', 0, 1, '', 0, 0, 26, 3),
(30, 'updateUser', '编辑用户', 0, 1, '', 1, 0, 26, 3),
(31, 'altPassword', '修改密码', 0, 1, '', 0, 0, 26, 3),
(32, 'deleteUser', '删除用户', 0, 1, '', 0, 0, 26, 3),
(33, 'Link', '链接管理', 0, 1, '', 1, 0, 1, 2),
(34, 'index', '链接列表', 0, 1, '', 1, 0, 33, 3),
(35, 'addLink', '新增链接', 0, 1, '', 1, 0, 33, 3),
(36, 'altLink', '编辑链接', 0, 1, '', 0, 0, 33, 3),
(37, 'delLink', '删除链接', 0, 1, '', 0, 0, 33, 3),
(38, 'Copyright', '版权信息', 0, 1, '', 1, 0, 1, 2),
(39, 'index', '版权显示', 0, 1, '', 1, 0, 38, 3),
(40, 'Nav', '导航管理', 0, 1, '', 1, 0, 1, 2),
(41, 'index', '导航设置', 0, 1, '', 1, 0, 40, 3),
(42, 'Homenode', '前端链接节点', 0, 1, '', 1, 0, 1, 2),
(43, 'index', '节点列表', 0, 1, '', 1, 0, 42, 3),
(44, 'searchContents', '搜索文章', 0, 1, '', 0, 0, 8, 3),
(45, 'noAuditList', '未审核文章列表', 0, 1, '', 1, 0, 8, 3);

-- --------------------------------------------------------

--
-- 表的结构 `r_role`
--

DROP TABLE IF EXISTS `r_role`;
CREATE TABLE IF NOT EXISTS `r_role` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `r_role`
--

INSERT INTO `r_role` (`id`, `name`, `title`, `pid`, `status`, `remark`) VALUES
(1, 'user', '管理员', NULL, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `r_role_user`
--

DROP TABLE IF EXISTS `r_role_user`;
CREATE TABLE IF NOT EXISTS `r_role_user` (
  `role_id` mediumint(9) UNSIGNED DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `r_role_user`
--

INSERT INTO `r_role_user` (`role_id`, `user_id`) VALUES
(1, '2');

-- --------------------------------------------------------

--
-- 表的结构 `r_user`
--

DROP TABLE IF EXISTS `r_user`;
CREATE TABLE IF NOT EXISTS `r_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `phone` varchar(11) NOT NULL COMMENT '手机号码',
  `login_count` int(11) NOT NULL DEFAULT '0',
  `register_time` int(11) NOT NULL,
  `last_login_time` int(11) NOT NULL,
  `last_login_ip` varchar(32) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remark` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `r_user`
--

INSERT INTO `r_user` (`id`, `username`, `nickname`, `password`, `email`, `phone`, `login_count`, `register_time`, `last_login_time`, `last_login_ip`, `status`, `remark`) VALUES
(1, 'admin', 'MangoLau', 'e1f1ee0cfcbb93ea2ffe9e44df18395c', '853779003@qq.com', '13750505530', 3, 111111, 1477639488, '0.0.0.0', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
