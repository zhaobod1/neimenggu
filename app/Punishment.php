<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    //
    public function direct_admin_user()
    {
        return $this->hasOne(AdminUser::class,'id','direct_admin_id');
    }

    public function indirect_admin_user()
    {
        return $this->hasOne(AdminUser::class,'id','indirect_admin_id');
    }

//    public function problem()
//    {
//        return $this->hasOne(Problem::class,'id','id');
//    }

    public function department()
    {
        //return $this->belongsToMany('')
    }
//
}
