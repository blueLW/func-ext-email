<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 19:59
 * Desc: 邮件路由
 */
use \think\facade\Route;
//邮箱列表
Route::get('admin/email/list','admin/email/index');
