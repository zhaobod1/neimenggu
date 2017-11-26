<?php

namespace App\Admin\Controllers;

use App\LoanList;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Auth;

class LoanRecordController extends BaseController
{
    use ModelForm;
    private $loanStatus;
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        $this->loanStatus=request()->get('status',null);
        if ($this->loanStatus!=null) {
            session([
                'loanStatus'=>$this->loanStatus
            ]);
        }
        return Admin::content(function (Content $content) {
            switch ($this->loanStatus){
                case config('constants.ADMIN_MODULE.LOAN_STATUS.CHECKING'):
                    $content->header('待审核记录');
                    $content->description('记录列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_STATUS.LOANING'):
                    $content->header('待放款记录');
                    $content->description('记录列表');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_STATUS.LOANED'):
                    $content->header('已放款记录');
                    $content->description('记录列表');
                    break;
                default:
                    $content->header('全部记录');
                    $content->description('记录列表');
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

            switch ($this->loanStatus){
                case config('constants.ADMIN_MODULE.LOAN_STATUS.CHECKING'):
                    $content->header('待审核记录');
                    $content->description('新增');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_STATUS.LOANING'):
                    $content->header('待放款记录');
                    $content->description('新增');
                    break;
                case config('constants.ADMIN_MODULE.LOAN_STATUS.LOANED'):
                    $content->header('已放款记录');
                    $content->description('新增');
                    break;
                default:
                    $content->header('全部记录');
                    $content->description('新增');
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

            switch ($this->loanStatus){
                case config('constants.ADMIN_MODULE.LOAN_STATUS.CHECKING'):
                    $grid->model()->where('loan_status',1);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_STATUS.LOANING'):
                    $grid->model()->where('loan_status',2);
                    break;
                case config('constants.ADMIN_MODULE.LOAN_STATUS.LOANED'):
                    $grid->model()->where('loan_status',3);
                    break;
                default:
            }

            $grid->id('编号')->sortable();
            $grid->column('user.name','申请人');
            $grid->column('loan_price','贷款金额');
            $grid->column('interest','预计利息');
            $grid->column('period','贷款周期');
            $grid->column('type','贷款类型')->editable('select',$this->loanTypeOptions);
            $grid->column('level_income','收入水平')->editable('select',$this->incomeOptions);
            $grid->column('use_of_fund','资金用途')->editable('select',$this->fundOptions);
            $grid->column('loan_status','申请状态')->editable('select',$this->loanStatOptions);
            //$grid->column('note','备注说明');
            $grid->column('created_at','申请提交时间');
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
            $ext = strrchr(\Request::getPathInfo(),'/');
            $form->tab('申请贷款',function ($form) {
                $form->text('user_id', '贷款用户ID')->rules('required', [
                    'required' => '贷款用户ID未填写',
                ]);
                $form->text('loan_price','贷款金额')->rules('required', [
                    'required' => '贷款金额未填写',
                ]);
                $form->select('level_income', '收入水平')->options($this->incomeOptions);
                $form->select('use_of_fund', '资金用途')->options($this->fundOptions);
                $form->select('type', '申贷类型')->options($this->loanTypeOptions);
                $form->textarea('note','贷款备注说明')->rows(3);
                $form->text('admin_id', '管理员ID')->rules('required', [
                    'required' => '管理员ID未填写',
                ]);
            });
            $form->tab('申请管理',function ($form) {
                $form->hidden('loan_plan', '借款方案');
                $form->text('interest','预计利息');
                $form->text('expire_interest','逾期利息');
                $form->select('loan_status','申请状态')->options($this->loanStatOptions)->default('1');
            });
            if($ext == '/edit') {
                $form->tab('借款明细', function ($form) {
                    $form->display('id', '订单编号');
                    $form->select('type', '申贷类型')->options($this->loanTypeOptions);
                    $form->display('created_at', '借款日期');
                    $form->text('loan_plan', '借款方案');
                });
                $form->tab('还款明细', function ($form) {
                    $form->display('loan_price', '本金');
                    $form->display('interest', '预计利息');
                    $form->display('expire_interest', '逾期利息');
                });
            }
            //$form->display('id', 'ID');


//            $form->display('created_at', 'Created At');
//            $form->display('updated_at', 'Updated At');
        });
    }
}
