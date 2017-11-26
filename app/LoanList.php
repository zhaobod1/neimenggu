<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanList extends Model
{
    protected $fillable=[
        'user_id',
        'loan_price',
        'level_income',
        'note',
        'use_of_fund',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function finance_pro()
    {
        return $this->belongsTo(FinancePro::class,'user_id','user_id');
    }

    public function admin_user()
    {
        return $this->belongsTo(AdminUser::class,'admin_id');
    }
}
