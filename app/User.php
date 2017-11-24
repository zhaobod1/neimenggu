<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $sex
 * @property int|null $age
 * @property string|null $birth
 * @property int|null $country
 * @property int|null $province
 * @property int|null $city
 * @property int|null $county
 * @property string|null $address
 * @property string|null $education
 * @property string|null $college
 * @property string|null $id_card
 * @property string|null $id_card_pic_front
 * @property string|null $id_card_pic_back
 * @property string|null $bank_card
 * @property string|null $bank_name
 * @property string|null $bank_location
 * @property string|null $bank_phone
 * @property string|null $mobile_phone
 * @property int|null $is_company
 * @property string|null $company_name
 * @property string|null $credential
 * @property string|null $business_license_pic
 * @property string|null $organization_code_pic
 * @property int $status_identity_auth
 * @property int $status_profile_auth
 * @property int $status_bank_auth
 * @property int $status_mobile_phone_auth
 * @property int $status_company_auth
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBankCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBankLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBankPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBusinessLicensePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCollege($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCredential($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIdCardPicBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIdCardPicFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOrganizationCodePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatusBankAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatusCompanyAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatusIdentityAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatusMobilePhoneAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatusProfileAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $nick_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNickName($value)
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'is_company',
        'status_identity_auth',
        'status_profile_auth',
        'status_bank_auth',
        'status_mobile_phone_auth',
        'status_company_auth',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    public function financePro()
    {
        return $this->hasOne(FinancePro::class);
    }

    public function addrPro(){
        return $this->hasOne(Addr::class);
    }
}
