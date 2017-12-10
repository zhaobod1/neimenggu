<?php

namespace App\Admin\Controllers;

use App\Problem;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ProblemController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('问题控制器');
            $content->description('问题列表');

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

            $content->header('问题控制器');
            $content->description('修改问题描述');

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

            $content->header('问题控制器');
            $content->description('新增问题');

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
        return Admin::grid(Problem::class, function (Grid $grid) {
            //隐藏 业务种类，检查项目名称，防线 这三大ROOT，避免误删
            $grid->model()->whereNotIn('id', [1, 2, 3]);

            $grid->id('ID')->sortable();
            $grid->column('name','问题名');
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Problem::class, function (Form $form) {
            $items = Problem::where('parent_id',0)->get();
            foreach($items as $item){
                $options[$item->id] = $item->name;
            }
            $form->display('id', 'ID');
            $form->select('parent_id','所属分类')->options($options)->rules('required', [
                'required' => '您没有选择分类',
            ]);
            $form->text('name','新建问题名称')->rules('required', [
                'required' => '您没有填写问题名',
            ]);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }
}
