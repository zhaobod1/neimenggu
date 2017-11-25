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

            $this->isCompany = request()->get('is_company',null);
            if ($this->isCompany!=null) {
                //存入session是为了后边新增按钮时候识别是企业还是个人。
                session([
                    'isCompany'=>$this->isCompany
                ]);
            }

	        if (session('isCompany')) {
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
            $content->description('编辑');
            //$content->description('手机：'.($model->mobile_phone?:"未填写"));

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

//            $content->header('header');
//            $content->description('description');
            if (session('isCompany')) {
                $content->header('企业用户');
                $content->description('列表');
            } else {
                $content->header('个人用户');
                $content->description('列表');
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
        return Admin::grid(User::class, function (Grid $grid) {
        	if ($this->isCompany) {
                $grid->model()->where('is_company',1);
                // select * from user where is_company=1
	        } else {
                $grid->model()->where('is_company',0);
//              $grid->model()->where('finance_pro.is_company',0);
	        }

	        $grid->paginate(25);
	        $grid->disableExport();

            $grid->id('编号')->sortable();
        	$grid->column('nick_name','姓名');
            if ($this->isCompany) {
                $grid->column('name','公司名');
            }
        	$grid->sex('性别')->display(function($sex){
        	    return $sex ? '女' : '男';
            });
        	$grid->column('age','年龄');
        	$grid->column('education','学历');
        	$grid->column('college','学校');
        	$grid->column('status_profile_auth','个人信息认证')->editable('select',$this->checkOptions);
        	$grid->column('status_identity_auth','身份认证')->editable('select',$this->checkOptions);
        	$grid->column('status_bank_auth','收款信息认证')->editable('select',$this->checkOptions);
        	$grid->column('status_mobile_phone_auth','手机认证')->editable('select',$this->checkOptions);
            if ($this->isCompany) {
                $grid->column('status_company_auth','企业资质认证')->editable('select',$this->checkOptions);
            }


            $grid->column('updated_at','更新');
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
//		        $form->display('id', '编号');
		        $form->text('name','账号')->rules('required', [
                    'required' => '账号未填写',
                ]);
		        $form->text('nick_name','姓名')->rules('required', [
                    'required' => '姓名未填写',
                ]);
                $form->password('password','密码')->rules('required', [
                    'required' => '密码未填写',
                ]);

		        $form->radio('sex','性别')->options($this->sexOptions);
                $form->text('age','年龄');
		        $form->date('birth','生日');
		        $form->text('education','学历')->placeholder('专科/本科/硕士/博士等');
		        $form->text('college','毕业学校');
                $form->select('status_profile_auth', '个人信息认证')->options($this->checkOptions);





                $form->hidden('is_company','是否是公司')->default(session('isCompany'));
        	});
	        $form->tab('身份认证',function ($form) {
                $form->text('finance_pro.id_card','身份证号码');
		        //$form->text('id_card','身份证号码');
		        //使用随机生成文件名 (md5(uniqid()).extension)
		        $form->image('finance_pro.id_card_pic_front','身份证正面照片')->uniqueName();
		        $form->image('finance_pro.id_card_pic_back','身份证反面面照片')->uniqueName();
                $form->select('status_identity_auth', '身份认证')->options($this->checkOptions);
	        });
	        $form->tab('收款信息',function ($form) {
		        $form->text('finance_pro.bank_card','银行卡号');
		        $form->text('finance_pro.bank_name','银行名称');
		        $form->text('finance_pro.bank_location','开户行地址');
		        $form->mobile('finance_pro.bank_phone','银行预留电话')->options(['mask'=>'999 9999 9999']);
                $form->select('status_bank_auth', '收款信息认证')->options($this->checkOptions);
	        });
	        $form->tab('手机认证',function ($form) {
		        $form->mobile('finance_pro.mobile_phone','手机号码')->options(['mask'=>'999 9999 9999']);
                $form->select('status_mobile_phone_auth', '手机认证')->options($this->checkOptions);
	        });
            if(session('isCompany')) {
                $form->tab('企业资质认证',function ($form) {
                    $form->text('finance_pro.company_name','公司名称');
                    $form->text('finance_pro.credential','证件代码');
                    $form->image('finance_pro.business_license_pic','营业执照')->uniqueName();
                    $form->image('finance_pro.organization_code_pic','组织代码证')->uniqueName();

                    $form->select('status_company_auth', '企业认证')->options($this->checkOptions);

                });
            }



        });
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if ($this->form()->destroy($id)) {
            $finance = $user->finance_pro;
            if ($finance != null)
            $finance->delete();
            return response()->json([
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ]);
        }
    }


}
