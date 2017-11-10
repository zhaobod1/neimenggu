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
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {


        	$model=User::findOrFail($id);

            $content->header($model->name);
            $content->description('手机：'.($model->mobile_phone?:"未填写"));

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
        	$grid->column('nick_name','姓名');
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
        	$form->tab('基本信息',function ($form) {
		        $form->display('id', '编号');
		        $form->text('name','账号');
		        $form->text('nick_name','姓名');
		        $form->radio('sex','性别')->options($this->sexOptions);
		        $form->date('birth','生日');
		        $form->text('education','学历')->placeholder('专科/本科/硕士/博士等');
		        $form->text('college','毕业学校');
	        });
	        $form->tab('身份认证',function ($form) {
		        $form->text('id_card','身份证');
		        // 使用随机生成文件名 (md5(uniqid()).extension)
		        $form->image('id_card_pic_front','身份证正面照片')->uniqueName();
		        $form->image('id_card_pic_back','身份证反面面照片')->uniqueName();
	        });
	        $form->tab('收款信息',function ($form) {
		        $form->text('bank_card','银行卡号');
		        $form->text('bank_name','银行名称');
		        $form->text('bank_location','开户行地址');
		        $form->mobile('bank_phone','银行预留电话')->options(['mask'=>'999 9999 9999']);

	        });
	        $form->tab('手机认证',function ($form) {
		        $form->mobile('mobile_phone','手机号码')->options(['mask'=>'999 9999 9999']);

	        });
	        if($form->model()->is_company) {
		        $form->tab('企业资质认证',function ($form) {
			        $form->text('company_name','公司名称');
			        $form->text('credential','证件代码');
			        $form->image('business_license_pic','营业执照')->uniqueName();
			        $form->image('organization_code_pic','组织代码证')->uniqueName();


		        });
	        }


        });
    }




}
