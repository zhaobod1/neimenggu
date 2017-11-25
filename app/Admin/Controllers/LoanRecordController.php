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

            $content->header('header');
            $content->description('description');

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
            $grid->disableCreation();//禁用创建按钮

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
            $grid->type('贷款类型')->display(function($type){
                switch ($type){
                    case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_LOAN'):
                        return '农业贷款';
                    case config('constants.ADMIN_MODULE.LOAN_TYPE.BUILDING_PROPERTY_MORTGAGE'):
                        return '房产抵押贷款';
                    case config('constants.ADMIN_MODULE.LOAN_TYPE.SOCIETE_GENERALE_LOAN'):
                        return '兴业贷';
                    case config('constants.ADMIN_MODULE.LOAN_TYPE.REVITALIZE_COMMERCE'):
                        return '兴商贷';
                    case config('constants.ADMIN_MODULE.LOAN_TYPE.OCCUPATION_AIDED'):
                        return '助业贷';
                    case config('constants.ADMIN_MODULE.LOAN_TYPE.CIVIL_SERVANT'):
                        return '公务员消费贷款';
                    case config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_GUARANTEE_LOAN'):
                        return '助农担保贷款';
                    default :

                }
            });
            $grid->column('loan_price','贷款金额');
            $grid->column('interest','预计利息');
            $grid->column('period','贷款周期');
            $grid->column('loan_status','申请状态')->editable('select',$this->loanStatOptions);
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

            //$form->display('id', 'ID');
            $form->text('interest','预计利息');
            $form->text('period','贷款周期');
            $form->select('loan_status','申请状态')->options($this->loanStatOptions);

//            $form->display('created_at', 'Created At');
//            $form->display('updated_at', 'Updated At');
        });
    }
}
