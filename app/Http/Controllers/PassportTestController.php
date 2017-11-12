<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PassportTestController extends Controller
{
	public function getCode()
	{
		$query = http_build_query([
			'client_id' => '3',
			'redirect_uri' => 'http://192.168.1.102:3000/callback',//本站的地址
			'response_type' => 'code',
			'scope' => '',
		]);
		return redirect('http://192.168.1.102:3002/oauth/authorize?' . $query);//授权服务器的地址
	}

	public function callback(Request $request)
	{

		$http = new Client();
		$response = $http->post('http://192.168.1.102:3002/oauth/token', [
			'form_params' => [
				'grant_type' => 'authorization_code',
				'client_id' => '3',
				'client_secret' => 'BxuM0ye0vHBarE9UWuRjFl1hsWE1UU4SzEMLplbU',
				'redirect_uri' => 'http://192.168.1.102:3000/callback',
				'code' => $request->code,
			],
		]);

		return json_decode((string) $response->getBody(), true);
	}


}
