<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class Filter extends AbstractTool
{


    public function render()
    {
        return view('admin.tools.filter');
    }
}