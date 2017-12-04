<?php

namespace App;

use Encore\Admin\Auth\Database\Menu;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function admin_users()
    {
        return $this->belongsToMany(AdminUser::class,'department_admin_user','depart_id','admin_id');
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }


}
