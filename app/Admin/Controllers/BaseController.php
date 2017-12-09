<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/11/10
 * Time: 下午12:24
 */

namespace App\Admin\Controllers;


class BaseController
{
	protected $checkOptions;
	protected $sexOptions;

	protected $incomeOptions;//收入水平选项
    protected $fundOptions;//资金用途选项
    protected $loanStatOptions;//申请状态选项
    protected $loanTypeOptions;//申请贷款类型

    protected $defineOptions;//防线选项
    protected $businessOptions;//业务选项

	/**
	 * BaseController constructor.
	 */
	public function __construct()
	{
		$this->checkOptions=[
			config('constants.ADMIN_MODULE.NOT_FILLED')=>'未填写',
			config('constants.ADMIN_MODULE.CHECKING')=>'审核中',
			config('constants.ADMIN_MODULE.CHECKED')=>'审核通过',
			config('constants.ADMIN_MODULE.REFUSED')=>'审核未通过'
		];
		$this->sexOptions=[0=>'男',1=>'女'];


        $this->loanTypeOptions=[
            config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_LOAN')=>'农业贷',
            config('constants.ADMIN_MODULE.LOAN_TYPE.BUILDING_PROPERTY_MORTGAGE')=>'房产抵押',
            config('constants.ADMIN_MODULE.LOAN_TYPE.SOCIETE_GENERALE_LOAN')=>'兴业贷款',
            config('constants.ADMIN_MODULE.LOAN_TYPE.REVITALIZE_COMMERCE')=>'兴商贷',
            config('constants.ADMIN_MODULE.LOAN_TYPE.OCCUPATION_AIDED')=>'助业贷',
            config('constants.ADMIN_MODULE.LOAN_TYPE.CIVIL_SERVANT')=>'公务员消费贷款',
            config('constants.ADMIN_MODULE.LOAN_TYPE.AGRICULTURAL_GUARANTEE_LOAN')=>'助农担保贷款',
        ];
        $this->incomeOptions=[
            config('constants.ADMIN_MODULE.INCOME_LEVEL.LEVEL_0')=>'5万以下',
            config('constants.ADMIN_MODULE.INCOME_LEVEL.LEVEL_1')=>'10万以下',
            config('constants.ADMIN_MODULE.INCOME_LEVEL.LEVEL_2')=>'20万以下',
        ];

        $this->fundOptions=[
            config('constants.ADMIN_MODULE.USE_OF_FUND.LINE_OPERATION')=>'生产经营',
            config('constants.ADMIN_MODULE.USE_OF_FUND.PERSONAL_CONSUMPTION')=>'个人消费',
            config('constants.ADMIN_MODULE.USE_OF_FUND.BUSINESS_CONSUMPTION')=>'创业消费',
            config('constants.ADMIN_MODULE.USE_OF_FUND.OTHERS')=>'其他',
        ];

        $this->loanStatOptions=[
            config('constants.ADMIN_MODULE.LOAN_STATUS.CHECKING')=>'待审核',
            config('constants.ADMIN_MODULE.LOAN_STATUS.LOANING')=>'待放款',
            config('constants.ADMIN_MODULE.LOAN_STATUS.LOANED')=>'已放款',
        ];

        $this->defineOptions=[
            config('constants.ADMIN_MODULE.DEFENSE_LINE.NOT_CHOOSE')=>'未选择',
            config('constants.ADMIN_MODULE.DEFENSE_LINE.FIRST')=>'一道防线',
            config('constants.ADMIN_MODULE.DEFENSE_LINE.SECOND')=>'二道防线',
            config('constants.ADMIN_MODULE.DEFENSE_LINE.THIRD')=>'三道防线',
        ];
        $this->businessOptions=[
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.NOT_CHOOSE')=>'未选择',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.COUNTER_BUSINESS')=>'柜面业务',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.LIABILITIES_AND_INTERMEDIARY')=>'负债及中间业务',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.E_BANK')=>'电子银行业务',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.CREDIT')=>'信贷业务',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.SELF_SERVICE_DEVICE')=>'自助设备',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.POS_BUSINESS')=>'POS机业务',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.COPY_SEND_CARD')=>'印押证卡、重空、尾箱',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.BALANCE_OF_ACCOUNT')=>'对账',
            config('constants.ADMIN_MODULE.TYPE_OF_BUSINESS.DAILY_CHECK_REPORT')=>'日查周报',
        ];


	}



}