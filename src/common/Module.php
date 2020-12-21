<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 14:49
 * Desc:
 */
namespace funext\email\common;

use tpext\common\Module as baseModule;

class Module extends baseModule
{
    protected $version = '1.0.0';

    protected $name = 'funext.email';

    protected $title = '功能扩展-邮件管理';

    protected $description = '邮件管理';

    protected $root = __DIR__ . '/../../';  //不用动

    //模块定义
    protected $modules = [
        'admin' => ['email'], //admin 模块，有哪些控制器
    ];

    //菜单
    protected $menus =
        [
            [
                'title' => '邮箱管理',
                'url' => '#',
                'icon' => 'mdi mdi-email-outline',
                'children' => [
                    [
                        'title' => '邮箱列表',
                        'url' => '/admin/email/index',
                        'icon' => 'mdi mdi-format-list-bulleted',
                    ],
                    //...
                ],
            ],
            //...
        ];

   //路由匹配成功，比如 访问 /test/test1/index
    public function pubblish() {
        //默认会替换静态资源路径
        // __ASSETS__ => /public/assets
        // __M_NAME__ => yourmodule
        // __MODULE__ => /public/assets/yourmodule
        // 你可以在视图里面直接使用

        parent::pubblish();
       //你的逻辑...
    }
}
