<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Department;

use App\DepartmentAdminUser;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;

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
        $this->departType=request()->get('type',null);
        if ($this->departType!=null) {
            session([
                'departType'=>$this->departType,
            ]);
        }
        return Admin::content(function (Content $content) {
            if(session('departType') == 31){
                $content->header('部门控制器');
            } else {
                $header = Menu::find(session('departType'))->title;
                $content->header($header);
            }


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

            if(session('departType') == 31){
                $content->header('部门控制器');
                $content->description('修改部门');
            } else {
                $header = Menu::find(session('departType'))->title;
                $content->header($header);
                $content->description('修改部门员工资料');
            }



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

            if(session('departType') == 31){
                $content->header('部门控制器');
                $content->description('新增部门');
            } else {
                $header = Menu::find(session('departType'))->title;
                $content->header($header);
                $content->description('新增部门员工');
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
        if(session('departType') == 31){
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
        }else{
            return Admin::grid(AdminUser::class, function (Grid $grid) {


                //部门下面所有用户ID
                $depart_user_id = [];
                //根据菜单ID获取部门的ID
                $depart_id = Department::where('menu_id',session('departType'))->value('id');
                foreach (Department::find($depart_id)->admin_users as $admin_user){
                    $depart_user_id[] = $admin_user->pivot->admin_user_id;
                }
                $grid->model()->whereIn('id',$depart_user_id);

                $grid->id('ID')->sortable();
                $grid->username(trans('admin.username'));
                $grid->name(trans('admin.name'));
                $grid->roles(trans('admin.roles'))->pluck('name')->label();
                $grid->created_at(trans('admin.created_at'));
                $grid->updated_at(trans('admin.updated_at'));
            });

        }
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        if(session('departType') == 31){
            return Admin::form(Menu::class, function (Form $form){
                $form->hidden('parent_id', '菜单父级ID')->default(25);
                $form->hidden('icon', '图标')->default('fa-dot-circle-o');
                $form->text('title','部门名称');
                $form->text('department.minister_id','部长ID');
                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');
                $form->saved(function (Form $form) {
                    Menu::find($form->model()->id)
                        ->update(['uri'=>'/admin-departments?type='.$form->model()->id]);
                });
            });
        } else{
//            return Admin::form(AdminUser::class, function (Form $form) {
//                $form->text('admin_user_id','员工ID');
//                $form->saving(function (Form $form) {
//                    $depart_id = Department::where('menu_id',session('departType'))->value('id');
//                    Department::find($depart_id)->admin_users()->attach($form->admin_user_id);
//                    return redirect('/nmg-admin/admin-departments');
//                });
//            });
            return Admin::form(AdminUser::class, function (Form $form) {
                $form->hidden('parent_id','父级ID')->default(Admin::user()->id);
                $form->text('username', trans('admin.username'))->rules('required');
                $form->text('name', trans('admin.name'))->rules('required');
                $form->image('avatar', trans('admin.avatar'));
                $form->password('password', trans('admin.password'))->rules('required|confirmed');
                $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
                    ->default(function ($form) {
                        return $form->model()->password;
                    });

                $form->ignore(['password_confirmation']);
                $form->multipleSelect('roles', trans('admin.roles'))->options(Role::all()->pluck('name', 'id'));
               // $form->multipleSelect('permissions', trans('admin.permissions'))->options(Permission::all()->pluck('name', 'id'));

                $form->saving(function (Form $form) {
                    if ($form->password && $form->model()->password != $form->password) {
                        $form->password = bcrypt($form->password);
                    }
                });
                $form->saved(function (Form $form) {
                    $depart_id = Department::where('menu_id',session('departType'))->value('id');

                    Department::find($depart_id)->admin_users()->attach($form->model()->id);
                });
                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');

            });
        }

    }


    public function destroy($id)
    {
        if ($this->form()->destroy($id)) {

            $depart_id = Department::where('menu_id',session('departType'))->value('id');
            Department::find($depart_id)->admin_users()->detach($id);

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


    public function update($id)
    {
        if(session('departType') == 31){
            $input = request()->all();
            $adminId=$input['department']['minister_id'];
            $depart_id = Department::where('menu_id',$id)->value('id');
            $res = \DB::table('department_admin_user')
                ->where([
                    'admin_user_id'=>$adminId,
                    'department_id'=>$depart_id
                ])
                ->get();
            if(count($res) == 0) {
                $error = new MessageBag([
                    'title'   => '填写错误',
                    'message' => '该员工ID不属于该部门.',
                ]);
                return back()->with(compact('error'));
            }else{

            }
        }

        return $this->form()->update($id);

    }



}
