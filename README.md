# func-ext-email
# 管理后台功能扩展-邮件管理

#### 基于tp5/tp6 myadmin 后端框架功能扩展

 - ##### myadmin 项目地址: <a href="https://gitee.com/ichynul/myadmin" target="_blank">https://gitee.com/ichynul/myadmin</a>

 - 1: 扩展目录命名方式 func-ext-功能英文简写,例如:func-ext-email:邮件管理功能扩展
 - 2: 子目录 data 存放安装时需要的sql文件,包括 install.sql/uninstall.sql
 - 3: src目录存放开发相关业务,common 文件是必须的,src/common/Module.php 是用来定义功能模块相关信息
 - 4: src/helper.php 用来自动加载 src/common/Module.php 文件,和定义相关助手函数
 - 5: 业务开发在src/ 目录下根据TP5/TP6中正常开发所需要建立的目录文件进行开发创建即可
 - 6: 模块不支持设置路由

#### 功能

- 1:邮件增删改查,列表,数据导出
- 2:邮件批量发送/单一发送
