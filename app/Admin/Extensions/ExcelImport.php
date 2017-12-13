<?php
namespace App\Admin\Extensions;

use Maatwebsite\Excel\Facades\Excel;

class ExcelImport extends Excel{
    public static function import(){
        $filePath = 'E:\Apache24\htdocs\test1.xlsx';
        Excel::load($filePath, function($reader) {
            //dd($reader);
            $data = $reader->toArray();
            dd($data);
        });
    }
}