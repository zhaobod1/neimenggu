<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class UserController extends BaseController
{
    use ModelForm;
    private $isCompany;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

	        $this->isCompany=request()->get('is_company',0);

	        if ($this->isCompany) {
		        $content->header('企业用户');
		        $content->description('列表');
	        } else {
		        $content->header('个人用户');
		        $content->description('列表');
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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(User::class, function (Grid $grid) {

        	if ($this->isCompany) {
        		$grid->model()->where('is_company',1);
	        } else {
		        $grid->model()->where('is_company',0);
	        }

	        $grid->paginate(25);
	        $grid->disableExport();

            $grid->id('编号')->sortable();
        	$grid->column('name','姓名');
        	$grid->column('sex','性别');
        	$grid->column('age','年龄');
        	$grid->column('education','学历');
        	$grid->column('college','学校');
        	$grid->column('status_profile_auth','个人信息认证')->editable('select',$this->checkOptions);
        	$grid->column('status_identity_auth','身份认证')->editable('select',$this->checkOptions);
        	$grid->column('status_bank_auth','收款信息认证')->editable('select',$this->checkOptions);
        	$grid->column('status_mobile_phone_auth','手机认证')->editable('select',$this->checkOptions);
        	if ($this->isCompany){
		        $grid->column('status_company_auth','企业认证')->editable('select',$this->checkOptions);

	        }


            $grid->updated_at('更新');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', '编号');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
