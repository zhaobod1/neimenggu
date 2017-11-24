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
}
