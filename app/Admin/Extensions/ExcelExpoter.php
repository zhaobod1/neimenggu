<?php

namespace App\Admin\Extensions;

use App\AdminUser;
use App\Problem;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExpoter extends AbstractExporter
{
    public function export()
    {
        Excel::create('Filename', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $items[] = [
                    'id'=>'序号',
                    'problem_desc'=>'存在问题',
                    'direct_admin_user'=>'直接责任人/单位',
                    'direct_punish_price'=>'处罚金额',
                    'other_punishment'=>'其他问责',
                    'type_of_business'=>'业务种类',
                    'department'=>'检查部门',
                    'check_project_name'=>'检查项目名称',
                    'punish_refer_num'=>'处罚文号',
                    'indirect_admin_user'=>'间接责任人',
                    'indirect_punish_price'=>'处罚金额',
                    'organization'=>'机构',
                    'defense_line'=>'防线',
                ];

                foreach ($this->getData() as $data){
                    $department = null;
                    if(AdminUser::find($data['direct_admin_id'])->departments()->value('menu_id')){
                        //根据admin_id与部门的多对多关联找到menu_id
                        $menu_id = AdminUser::find($data['direct_admin_id'])->departments()->value('menu_id');
                        //根据menu_id获取部门名称(菜单名就是部门名)
                        $department =  Menu::find($menu_id)->title;
                    }

                    $type_of_business = null;
                    if(Problem::find($data['type_of_business'])){
                        $type_of_business = Problem::find($data['type_of_business'])->name;
                    }

                    $check_project_name = null;
                    if(Problem::find($data['check_project_name'])){
                        $check_project_name = Problem::find($data['check_project_name'])->name;
                    }

                    $defense_line = null;
                    if(Problem::find($data['defense_line'])){
                        $defense_line = Problem::find($data['defense_line'])->name;
                    }
                    $items[] = [
                        'id'=>$data['id'],
                        'problem_desc'=>$data['problem_desc'],
                        'direct_admin_user'=>$data['direct_admin_user']['name'],
                        'direct_punish_price'=>$data['direct_punish_price'],
                        'other_punishment'=>$data['other_punishment'],
                        'type_of_business'=>$type_of_business,
                        'department'=>$department,
                        'check_project_name'=>$check_project_name,
                        'punish_refer_num'=>$data['punish_refer_num'],
                        'indirect_admin_user'=>$data['indirect_admin_user']['name'],
                        'indirect_punish_price'=>$data['indirect_punish_price'],
                        'organization'=>$data['organization'],
                        'defense_line'=>$defense_line,
                    ];
                }

                $sheet->rows($items);

            });

        })->export('xls');
    }
}