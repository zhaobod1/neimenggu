<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FinancePro
 *
 * @property string $bank_card
 * @property string $bank_location
 * @property string $bank_name
 * @property string $bank_phone
 * @property string $business_license_pic
 * @property string $company_name
 * @property \Carbon\Carbon|null $created_at
 * @property string $credential
 * @property int $id
 * @property string $id_card
 * @property string $id_card_pic_back
 * @property string $id_card_pic_front
 * @property int $is_company
 * @property string $mobile_phone
 * @property string $organization_code_pic
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereBankCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereBankLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereBankPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereBusinessLicensePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereCredential($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereIdCardPicBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereIdCardPicFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereIsCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereOrganizationCodePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancePro whereUserId($value)
 * @mixin \Eloquent
 */
class FinancePro extends Model
{
    //
    protected $fillable=[
        'user_id',
        'company_name',
        'credential',
        'business_license_pic',
        'organization_code_pic',
        'id_card',
        'id_card_pic_front',
        'id_card_pic_back',
        'bank_card',
        'bank_name',
        'bank_location',
        'bank_phone',
        'mobile_phone',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan_list_pro(){
        return $this->hasMany(LoanList::class);
    }

}
