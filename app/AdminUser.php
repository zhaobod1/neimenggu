<?php

namespace App;

use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    //

    public function loan_list_pro()
    {
        return $this->hasMany(LoanList::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class,'department_admin_user','admin_user_id','department_id')
            ->using(DepartmentAdminUser::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'admin_role_users','user_id','role_id');
    }

}
