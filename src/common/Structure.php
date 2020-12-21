<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/21
 * Time: 16:48
 * Desc: 数据结构体文件
 */
namespace funcext\email\common;
class Structure {
    const EMAIL_CONFIG_STRUCTURE =  [
            'smtp_host'=>'smtp1.xample.com',
            'sender'=>[
                [
                    'username'=>'user@example.com-账号1',           //账户名1
                    'password'=>'secret-授权码1',                   //授权登录码1
                    'name'=>'XXX公司-账号1姓名/发送者称呼'
                ],
                [
                    'username'=>'user@example.com-账号2',           //账户名2
                    'password'=>'secret-授权码2',                   //授权登录码2
                    'name'=>'XXX机构-账号1姓名/发送者称呼'
                ],
                //...
            ]
        ];
}
