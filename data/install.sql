
CREATE TABLE IF NOT EXISTS `__PREFIX__admin_email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '邮箱昵称',
  `enable` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '1:开启/0:禁用',
  `create_time` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '添加时间',
  `update_time` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '更新时间',
  `remark` varchar(20) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='邮箱记录表';
