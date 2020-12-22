<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 16:01
 * Desc: 邮箱管理
 */
namespace funcext\email\admin\controller;
use think\Controller;
use think\exception\ValidateException;
use think\Request;
use tpext\builder\traits\HasBuilder;
use funcext\email\admin\model\AdminEmail;

class Email extends Controller
{
    use HasBuilder;
    protected $dataModel;
    protected function initialize()
    {
        $this->dataModel = new AdminEmail();
        $this->pageTitle = '邮箱管理';
        $this->enableField = 'enable';        //启用禁用字段
        $this->pagesize = 30;
    }

    /**邮箱列表
     * @param array $data
     * @time 2020/12/11 19:42
     * @author LW
     */
    protected function buildTable(&$data = [])
    {
        $table = $this->table;
        $table->show('id', '序号');
        $table->show('email', 'EMAIL');
        //$table->match('enable', '启用')->options([0 => '<label class="label label-danger">禁用</label>', 1 => '<label class="label label-success">正常</label>']);
        $table->switchBtn('enable', '启用')->default(1)->autoPost()->mapClass('/admin/email/index', 'hidden', 'url');
        $table->show('create_time', '创建时间')->getWrapper()->addStyle('width:180px');
        //csv
        $table->getToolbar()
            ->btnAdd()
            ->btnDelete('','批量删除')
            ->btnEnableAndDisable('启用','禁用')
            ->btnRefresh('刷新')
            ->btnExportS(['xlsx'=>'xlsx文件'],'/admin/email/download','导出文件');        //定义下载按钮,下载地址
        $table->getActionbar()
            ->btnEdit()
            ->btnView()
            ->btnDelete();
    }

    /**构建编辑表单
     * @param $isEdit
     * @param array $data
     * @time 2020/12/8 10:08
     * @author LW
     */
    protected function buildForm($isEdit, &$data = []){
        $form = $this->form;
        $form->text('email', '邮箱地址')->required()->maxlength(60);
        if ($isEdit) {
            $form->show('create_time', '添加时间');
        }
    }

    /**保存数据
     * @param int $id
     * @return \think\response\Json|\think\response\View
     * @time 2020/12/8 10:08
     * @author LW
     */
    private function save($id = 0)
    {
        $data = request()->only(['email'], 'post');
        try {
            $validate_map = [
                'email|邮箱' => 'email'
            ];
            $result = $this->validate($data,$validate_map);
        }catch (ValidateException $exception){
            $this->error($exception->getMessage());
        }

        //验证数据是否重复
        $email = trim($data['email']);
        $exist = $this->dataModel->where(['email' =>$email])->find();
        if(!empty($exist['email']) && $exist['id'] != $id){
            $this->error('该邮箱已被占用,请更换其他邮箱');
        }

        //保存操作
        return $this->doSave($data, $id);
    }

    /**下载文件
     * @param Request $request
     * @return \think\response\Json
     * @time 2020/12/8 14:55
     * @author LW
     */
    public function download(Request $request)
    {
        $response = $this->export()->getContent();              //调用系统底层下载组件
        $data = json_decode($response,true);
        $xlsx_path = $data['data'] ?? '';                       //文件路径
        $file_path = empty($xlsx_path) ? '' : APP_PATH.$xlsx_path;

        if(!empty($file_path) && is_file($file_path)){
            $dowload = $request->domain().$xlsx_path;           //完整的下载链接
            return json(['code'=>1,'msg'=>'文件导出成功,点击下载!','data'=>$dowload]);
        }
        return json(['code'=>0,'msg'=>'文件导出失败,请刷新重试!']);
    }
}
