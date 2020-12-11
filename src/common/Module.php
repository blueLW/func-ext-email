<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 14:49
 * Desc:
 */
namespace tpext\email\common;

use tpext\common\Module as baseModule;

class Module extends baseModule
{
    protected $version = '1.0.0';

    protected $name = 'tpext.email';

    protected $title = '框架扩展-邮件管理测试';

    protected $description = '邮件管理测试';

    protected $root = __DIR__ . '/../../';  //不用动

    //模块定义
    protected $modules = [
        'admin' => ['testemail'], //admin 模块，有哪些控制器
    ];

    //菜单
    protected $menus =
        [
            [
                'title' => '邮箱管理测试',
                'url' => '#',
                'icon' => 'mdi mdi-account-card-details',
                'children' => [
                    [
                        'title' => '测试邮箱管理',
                        'url' => '/admin/testemail/index',
                        'icon' => 'mdi mdi-account-network',
                    ],
                    //...
                ],
            ],
            //...
        ];

/*    //路由匹配成功，比如 访问 /test/test1/index
    public function pubblish() {
        //默认会替换静态资源路径
        // __ASSETS__ => /public/assets
        // __M_NAME__ => yourmodule
        // __MODULE__ => /public/assets/yourmodule
        // 你可以在视图里面直接使用

        parent::pubblish();
       //你的逻辑...
    }*/
}
