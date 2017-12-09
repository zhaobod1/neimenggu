<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Problem;
use App\Punishment;

use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PunishController extends Controller
{
    use ModelForm;
    protected $businessOptions;//业务种类
    protected $defineOptions;//防线
    protected $checkNameOptions;//检查项目名称

    public function __construct()
    {
        $items = Problem::where('parent_id',1)->get();
        foreach($items as $item){
            $this->businessOptions[$item->id] = $item->name;
        }
        $items = Problem::where('parent_id',2)->get();
        foreach($items as $item){
            $this->checkNameOptions[$item->id] = $item->name;
        }
        $items = Problem::where('parent_id',3)->get();
        foreach($items as $item){
            $this->defineOptions[$item->id] = $item->name;
        }
    }

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(Punishment::class, function (Grid $grid) {
            $grid->filter(function($filter){
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                // 在这里添加字段过滤器
                $filter->like('problem_desc', '问题描述');
                $filter->like('direct_admin_user.name', '直接责任人');
            });


            $grid->id('ID')->sortable();
            $grid->column('problem_desc','问题描述');
            $grid->column('direct_admin_user.name','直接责任人');
            $grid->column('direct_punish_price','处罚金额');
            $grid->column('other_punishment','其他问责');
            $grid->column('type_of_business','业务种类')->editable('select',$this->businessOptions);
            //根据直接责任人ID来获取其所属部门ID
            $grid->column('检查部门')->display(function () {
                if(AdminUser::find($this->direct_admin_id)->departments()->value('menu_id')){
                    //根据admin_id与部门的多对多关联找到menu_id
                    $menu_id = AdminUser::find($this->direct_admin_id)->departments()->value('menu_id');
                    //根据menu_id获取部门名称(菜单名就是部门名)
                    return Menu::find($menu_id)->title;
                }else{
                    return '';
                }

            });
            $grid->column('check_project_name','检查项目名称')->editable('select',$this->checkNameOptions);
            $grid->column('punish_refer_num','处罚文号');
            $grid->column('indirect_admin_user.name','间接接责任人');
            $grid->column('indirect_punish_price','处罚金额');
            $grid->column('organization','机构');
            $grid->column('defense_line','防线')->editable('select',$this->defineOptions);
//            $grid->created_at();
//            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Punishment::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->textarea('problem_desc','问题描述');
            $form->text('direct_admin_id','直接负责人ID');
            $form->text('direct_punish_price','直接负责人处罚金额');
            $form->text('other_punishment','其他问责');
            $form->select('type_of_business','业务种类')->options($this->businessOptions);
            $form->select('check_project_name','检查项目名称')->options($this->checkNameOptions);
            $form->text('punish_refer_num','处罚文号');
            $form->text('indirect_admin_id','直接负责人ID');
            $form->text('indirect_punish_price','间接负责人处罚金额');
            $form->text('organization','机构');
            $form->select('defense_line','防线')->options($this->defineOptions);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
