<?php

namespace App\Http\Controllers;

use Encore\Admin\Auth\Database\Menu;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth')->except(['test']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('home');
	}


	public function test()
	{
        $tmp = Menu::find(26);
        dd($tmp->department);
	}
}
