<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Department;

use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class DepartmentController extends Controller
{
    use ModelForm;
    private $departType;
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        $this->departType=request()->get('status',null);
        if ($this->departType!=null) {
            session([
                'departType'=>$this->departType
            ]);
        }
        return Admin::content(function (Content $content) {

            $content->header('部门控制器');
            $content->description('部门列表');

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

            $content->header('部门控制器');
            $content->description('修改部门');

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

            $content->header('部门控制器');
            $content->description('新增部门');

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
        return Admin::grid(Menu::class, function (Grid $grid) {
            $grid->model()->where('parent_id',25)
                          ->where('id','!=',31);//去除部门控制器
            $grid->id('ID')->sortable();
            $grid->column('title','部门名称');
            $grid->department()->minister_id('部长')->display(function($minister_id){
                if(AdminUser::find($minister_id)){
                    return AdminUser::find($minister_id)->name;
                }else{
                    return '';
                }
            });
            $grid->column('updated_at','更新时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Menu::class, function (Form $form) {

            $form->hidden('parent_id', '菜单父级ID')->default(25);
            $form->hidden('icon', '图标')->default('fa-dot-circle-o');
            $form->text('title','部门名称');
            $form->text('department.minister_id','部长ID');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }




}
