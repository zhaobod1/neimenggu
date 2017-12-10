<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\Filter;
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
use Illuminate\Support\MessageBag;

class PunishController extends Controller
{
    use ModelForm;
    protected $businessOptions;//业务种类
    protected $defineOptions;//防线
    protected $checkNameOptions;//检查项目名称

    public function __construct()
    {
        //查找父级为 业务种类 下的问题数据
        $items = Problem::where('parent_id',1)->get();
        foreach($items as $item){
            $this->businessOptions[$item->id] = $item->name;
        }

        //查找父级为 检查项目名称 下的问题数据
        $items = Problem::where('parent_id',2)->get();
        foreach($items as $item){
            $this->checkNameOptions[$item->id] = $item->name;
        }


        //查找父级为 防线 下的问题数据
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
            if (\Request::get('guilty_id') != null){
                $guilty_name = AdminUser::find(\Request::get('guilty_id'))->name;
                $content->header($guilty_name);
                $content->description('违规条目');
            }else{
                $content->header('问责记录');
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

            $content->header('问责记录');
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

            $content->header('问责记录');
            $content->description('新增');

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
        if(\Request::get('type') == 'filter'){
            return Admin::grid(Punishment::class, function (Grid $grid) {
                $grid->tools(function ($tools) {
                    $tools->append(new Filter());
                });
                $grid->model()->groupBy('direct_admin_id')
                    ->selectRaw(
                        'count(*) as sum, id,problem_desc,direct_admin_id,direct_punish_price,indirect_admin_id,indirect_punish_price,other_punishment,department_id,punish_refer_num,organization,type_of_business,check_project_name,defense_line,created_at,updated_at'
                    )
                    ->orderBy('sum','desc')
                    ->limit(10);
                $grid->column('sum','犯错统计');
                //$grid->column('direct_admin_user.name','直接责任人');
                $grid->column('direct_admin_user.name','直接责任人')->display(function ($name) {
                    return "<a href='?guilty_id=$this->direct_admin_id'>$name</a>";
                });
            });
        }elseif (\Request::get('guilty_id') != null){
            return Admin::grid(Punishment::class, function (Grid $grid) {
                $grid->tools(function ($tools) {
                    $tools->append(new Filter());
                });
                $grid->model()->groupBy('problem_desc')
                    ->selectRaw(
                        'count(*) as sum, id,problem_desc,direct_admin_id,direct_punish_price,indirect_admin_id,indirect_punish_price,other_punishment,department_id,punish_refer_num,organization,type_of_business,check_project_name,defense_line,created_at,updated_at'
                    )
                    ->orderBy('sum','desc')
                    ->limit(10);
                $grid->model()->where('direct_admin_id',\Request::get('guilty_id'));
                $grid->column('sum','犯错频率');
                $grid->column('problem_desc','违规条目');
            });
        }

        return Admin::grid(Punishment::class, function (Grid $grid) {
            $grid->tools(function ($tools) {
                $tools->append(new Filter());
            });
            $grid->filter(function($filter){
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                // 在这里添加字段过滤器
                $filter->like('problem_desc', '问题描述');
                $filter->like('direct_admin_user.name', '直接责任人');
            });


            $grid->id('ID')->sortable();
            //$grid->column('problem_desc','问题描述');
            //$grid->column('sum','犯错统计');
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
            $form->select('type_of_business','业务种类')
                ->options($this->businessOptions)
                ->rules('required', [
                    'required' => '您没有选择业务种类',
                ]);
            $form->select('check_project_name','检查项目名称')
                ->options($this->checkNameOptions)
                ->rules('required', [
                    'required' => '您没有选择检查项目名称',
                ]);
            $form->text('punish_refer_num','处罚文号');
            $form->text('indirect_admin_id','间接负责人ID');
            $form->text('indirect_punish_price','间接负责人处罚金额');
            $form->text('organization','机构');
            $form->select('defense_line','防线')
                ->options($this->defineOptions)
                ->rules('required', [
                    'required' => '您没有选择防线',
                ]);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function update($id)
    {
        $input = request()->all();

        //用户ID是否存在判断
        $AdminId=$input['direct_admin_id'];
        if(AdminUser::find($AdminId) == null) {
            $error = new MessageBag([
                'title'   => '填写错误',
                'message' => '该员工ID不存在.',
            ]);
            return back()->with(compact('error'));
        }

        return $this->form()->update($id);

    }

    public function store()
    {

        $input = request()->all();

        //用户ID是否存在判断
        $AdminId=$input['direct_admin_id'];
        if(AdminUser::find($AdminId) == null) {
            $error = new MessageBag([
                'title'   => '填写错误',
                'message' => '该员工ID不存在.',
            ]);
            return back()->with(compact('error'));
        }
        return $this->form()->store();
    }
}
