<?php

namespace App;

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
        return $this->belongsToMany(Department::class,'department_admin_user','admin_id','depart_id');
    }
}
