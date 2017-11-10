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

	/**
	 * BaseController constructor.
	 * @param $checkOptions
	 */
	public function __construct()
	{
		$this->checkOptions=[
			config('constants.ADMIN_MODULE.NOT_FILLED')=>'未填写',
			config('constants.ADMIN_MODULE.CHECKING')=>'审核中',
			config('constants.ADMIN_MODULE.CHECKED')=>'审核通过',
			config('constants.ADMIN_MODULE.REFUSED')=>'审核未通过'
		];
	}


}