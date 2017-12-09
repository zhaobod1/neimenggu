<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/11/9
 * Time: 下午7:28
 */

return [
	'ADMIN_MODULE'=>[
		'NOT_FILLED'=>0,
		'CHECKING'=>1,
		'CHECKED'=>2,
		'REFUSED'=>3,

        //这里是贷款申请的常量集合
        //loan type 是贷款申请类型常量
        'LOAN_TYPE'=>[
            'AGRICULTURAL_LOAN'=>"0",//农业贷
            'BUILDING_PROPERTY_MORTGAGE'=>"1",//房产抵押
            'SOCIETE_GENERALE_LOAN'=>"2",//兴业贷款
            'REVITALIZE_COMMERCE'=>"3",//兴商贷
            'OCCUPATION_AIDED'=>"4",//助业贷
            'CIVIL_SERVANT'=>"5",//公务员消费贷款
            'AGRICULTURAL_GUARANTEE_LOAN'=>"6",//助农担保贷款
        ],
        //收入水平
        'INCOME_LEVEL'=>[
            'LEVEL_0'=>0,//5万以下
            'LEVEL_1'=>1,//10万以下
            'LEVEL_2'=>2,//20万以下

        ],
        //资金用途
        'USE_OF_FUND'=>[
            'LINE_OPERATION'=>0,//生产经营
            'PERSONAL_CONSUMPTION'=>1,//个人消费
            'BUSINESS_CONSUMPTION'=>2,//创业消费
            'OTHERS'=>3,//其他
        ],

        //贷款申请状态
        'LOAN_STATUS'=>[
            'CHECKING'=>"1",//待审核
            'LOANING'=>"2",//待放款
            'LOANED'=>"3",//已放款
        ],

        'DEFENSE_LINE'=>[
            'NOT_CHOOSE'=>0,//未选择
            'FIRST'=>1,//一道防线
            'SECOND'=>2,//二道防线
            'THIRD'=>3,//三道防线
        ],

        'TYPE_OF_BUSINESS'=>[
            'NOT_CHOOSE'=>0,//未选择
            'COUNTER_BUSINESS'=>1,//柜面业务
            'LIABILITIES_AND_INTERMEDIARY'=>2,//负债及中间业务
            'E_BANK'=>3,//电子银行业务
            'CREDIT'=>4,//信贷业务
            'SELF_SERVICE_DEVICE'=>5,//自助设备
            'POS_BUSINESS'=>6,//POS机业务
            'COPY_SEND_CARD'=>7,//印押证卡、重空、尾箱
            'BALANCE_OF_ACCOUNT'=>8,//对账
            'DAILY_CHECK_REPORT'=>9,//日查周报
        ],
	]
];