<?php

namespace App\Admin\Controllers;

use App\LoanList;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use function GuzzleHttp\default_ca_bundle;
use Illuminate\Support\Facades\Auth;

class LoanListController  extends BaseController
{
    private $loanType;
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        $this->loanType=request()->get('type',null);
        if ($this->loanType!=null) {
            session([
                'loanType'=>$this->loanType
            ]);
        }

        return Admin::content(function (Content $content) {
            switch ($this->loanType){
                case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_LOAN'):
                    $content->header('农业贷款');
                    $content->description('申请列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.BUILDING_PROPERTY_MORTGAGE'):
                    $content->header('房产抵押贷款');
                    $content->description('申请列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.SOCIETE_GENERALE_LOAN'):
                    $content->header('兴业贷');
                    $content->description('申请列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.REVITALIZE_COMMERCE'):
                    $content->header('兴商贷');
                    $content->description('申请列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.OCCUPATION_AIDED'):
                    $content->header('助业贷');
                    $content->description('申请列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.CIVIL_SERVANT'):
                    $content->header('公务员消费贷款');
                    $content->description('申请列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_GUARANTEE_LOAN'):
                    $content->header('助农担保贷款');
                    $content->description('申请列表');
                    break;
                default:

            }


            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $model=LoanList::findOrFail($id);
            $content->header($model->user->name);
            $content->description('编辑');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            switch (session('loanType')){
                case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_LOAN'):
                    $content->header('农业贷款');
                    $content->description('申请');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.BUILDING_PROPERTY_MORTGAGE'):
                    $content->header('房产抵押贷款');
                    $content->description('申请');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.SOCIETE_GENERALE_LOAN'):
                    $content->header('兴业贷');
                    $content->description('申请');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.REVITALIZE_COMMERCE'):
                    $content->header('兴商贷');
                    $content->description('申请');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.OCCUPATION_AIDED'):
                    $content->header('助业贷');
                    $content->description('申请');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.CIVIL_SERVANT'):
                    $content->header('公务员消费贷款');
                    $content->description('申请');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_GUARANTEE_LOAN'):
                    $content->header('助农担保贷款');
                    $content->description('申请');
                    break;
                default:

            }

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(LoanList::class, function (Grid $grid) {

            switch ($this->loanType){
                case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_LOAN'):
                    $grid->model()->where('type',0);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.BUILDING_PROPERTY_MORTGAGE'):
                    $grid->model()->where('type',1);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.SOCIETE_GENERALE_LOAN'):
                    $grid->model()->where('type',2);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.REVITALIZE_COMMERCE'):
                    $grid->model()->where('type',3);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.OCCUPATION_AIDED'):
                    $grid->model()->where('type',4);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.CIVIL_SERVANT'):
                    $grid->model()->where('type',5);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_GUARANTEE_LOAN'):
                    $grid->model()->where('type',6);
                    break;
                default:
                    $grid->model()->where('type',null);
            }

            $grid->id('编号')->sortable();
            //$grid->type();
            $grid->column('user.name','姓名');
            $grid->column('finance_pro.mobile_phone','手机号');
            $grid->column('loan_price','贷款金额');
            $grid->column('level_income','收入水平')->editable('select',$this->incomeOptions);
            $grid->column('use_of_fund','资金用途')->editable('select',$this->fundOptions);
            $grid->column('note','备注说明');
            //$grid->created_at();
            $grid->updated_at('更新');

            $grid->column('admin_user.name','操作员');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(LoanList::class, function (Form $form) {


            $form->text('user_id', '贷款用户ID')->rules('required', [
                'required' => '贷款用户ID未填写',
            ]);;
            $form->text('loan_price','贷款金额')->rules('required', [
                'required' => '贷款金额未填写',
            ]);;
            $form->select('level_income', '收入水平')->options($this->incomeOptions);
            $form->select('use_of_fund', '资金用途')->options($this->fundOptions);
            $form->textarea('note','贷款备注说明')->rows(3);


            $form->hidden('type','贷款类型')->default(session('loanType'));
//            $form->display('created_at', 'Created At');
//            $form->display('updated_at', 'Updated At');
            $form->text('admin_id', '管理员ID')->rules('required', [
                'required' => '管理员ID未填写',
            ]);;
        });
    }
}
