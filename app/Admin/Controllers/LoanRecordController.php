<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\LoanList;

use App\User;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

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
            //根据权限是否显示删除按钮
            $grid->actions(function ($actions) {
                if (!Admin::user()->can('admin-loan-records.delete')) {
                    $actions->disableDelete();
                }
            });

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

            if(Admin::user()->isRole('credit-manager')){
                $grid->model()->where('admin_id',Admin::user()->id);

                $sons = \DB::table('admin_users')->where('parent_id',Admin::user()->id)->get();
                foreach ($sons as $son){
                    $grid->model()->orWhere('admin_id',$son->id);
                }
            }

            if (Admin::user()->isRole('credit-salesman')) {
                $grid->model()->where('admin_id',Admin::user()->id);
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
            $grid->column('admin_user.name','操作员');
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

                if(Admin::user()->can('admin-loan-records.change-admin-user-id')) {
                    $form->text('admin_id', '管理员ID')->rules('required', [
                        'required' => '管理员ID未填写',
                    ]);
                } else {
                    $form->hidden('admin_id', '管理员ID')->default(Admin::user()->id);
                }



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


    public function update($id)
    {
        $input = request()->all();

        //用户ID是否存在判断
        $UserId=$input['user_id'];
        if(User::find($UserId) == null) {
            $error = new MessageBag([
                'title'   => '填写错误',
                'message' => '该用户ID不存在.',
            ]);
            return back()->with(compact('error'));
        }

        //操作管理员ID判断
        $adminUserId=$input['admin_id'];
        if (Admin::user()->isRole('credit-manager')) {
            if(AdminUser::find($adminUserId) == null || !($adminUserId==Admin::user()->id || AdminUser::find($adminUserId)->parent_id==Admin::user()->id) ) {
                $error = new MessageBag([
                    'title'   => '没有权限',
                    'message' => '您只可以编辑您自己名下的员工ID.',
                ]);
                return back()->with(compact('error'));
            }
        }

        return $this->form()->update($id);

    }

    public function store()
    {

        $input = request()->all();
        //用户ID是否存在判断
        $UserId=$input['user_id'];
        if(User::find($UserId) == null) {
            $error = new MessageBag([
                'title'   => '填写错误',
                'message' => '该用户ID不存在.',
            ]);
            return back()->with(compact('error'));
        }
        //操作管理员ID判断
        $adminUserId=$input['admin_id'];
        //1.信贷业务员
        if (Admin::user()->isRole('credit-salesman')) {
            if ($adminUserId!=Admin::user()->id) {
                $error = new MessageBag([
                    'title'   => '没有权限',
                    'message' => '您只可以编辑您自己名下的贷款申请.',
                ]);
                return back()->with(compact('error'));
            }
        }
        elseif (Admin::user()->isRole('credit-manager')) {
            if(AdminUser::find($adminUserId) == null || !($adminUserId==Admin::user()->id || AdminUser::find($adminUserId)->parent_id==Admin::user()->id) ) {
                $error = new MessageBag([
                    'title'   => '没有权限',
                    'message' => '您只可以编辑您自己名下的员工ID.',
                ]);
                return back()->with(compact('error'));
            }

        }




        return $this->form()->store();
    }

}
