CREATE TABLE `__PREFIX__test_email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `email` varchar(60) DEFAULT '' COMMENT '描述',
  `create_time` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '添加时间',
  `update_time` datetime NOT NULL DEFAULT '2020-01-01 00:00:00' COMMENT '更新时间',
  `state` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='邮箱表';
