<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 16:01
 * Desc: 测试
 */
namespace tpext\email\admin\controller;
use think\Controller;
use think\Request;
use tpext\builder\traits\HasBuilder;
use tpext\email\model\TestEmail as TestEmailModel;

class TestEmail extends Controller
{
    use HasBuilder;
    protected $dataModel;
    protected function initialize()
    {
        $this->dataModel = new TestEmailModel();
        $this->pageTitle = '测试邮箱管理';
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
            ->btnExportS(['xlsx'=>'xlsx文件'],'/admin/testemail/upload','导出');
        $table->getActionbar()
            ->btnEdit()
            ->btnView()
            ->btnDelete();
    }

    /**下载文件
     * @param Request $request
     * @return \think\response\Json
     * @time 2020/12/8 14:55
     * @author LW
     */
    public function upload(Request $request)
    {
        $response = $this->export()->getContent();              //调用系统下载组件
        $data = json_decode($response,true);
        $xlsx_path = $data['data'] ?? '';
        $file_path = empty($xlsx_path) ? '' : APP_PATH.$xlsx_path;

        if(!empty($file_path) && is_file($file_path)){
            $dowload = $request->domain().$xlsx_path;           //完整的下载链接
            return json(['code'=>1,'msg'=>'文件导出成功,点击下载!','data'=>$dowload]);
        }
        return json(['code'=>0,'msg'=>'文件导出失败,请刷新重试!']);
    }
}
