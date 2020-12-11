<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 16:01
 * Desc: 测试
 */
namespace tpext\email\admin\controller;
use app\admin\model\AdminEmail;
use think\Controller;
use tpext\builder\traits\HasBuilder;

class Extension extends Controller
{
    use HasBuilder;
    protected $dataModel;
    protected function initialize()
    {
        $this->dataModel = new AdminEmail;
        $this->pageTitle = '测试';
        $this->enableField = 'state';               //启用禁用字段
        $this->pagesize = 30;
    }

    protected function buildTable(&$data = [])
    {
        $table = $this->table;
        $table->show('id', '序号');
        $table->show('email', 'EMAIL');
        $table->match('state', '启用')->options([0 => '<label class="label label-danger">禁用</label>', 1 => '<label class="label label-success">正常</label>']);
        //$table->switchBtn('state', '启用')->default(1)->autoPost()->mapClass('/admin/email/index', 'hidden', 'url');
        $table->show('create_time', '创建时间')->getWrapper()->addStyle('width:180px');
        //csv
        $table->getToolbar()
            ->btnAdd()
            ->btnDelete('','批量删除')
            ->btnEnableAndDisable('启用','禁用')
            ->btnRefresh('刷新')
            ->btnExportS(['xlsx'=>'xlsx文件'],'/admin/email/upload','导出');
        $table->getActionbar()
            ->btnEdit()
            ->btnView()
            ->btnDelete();
    }
}
