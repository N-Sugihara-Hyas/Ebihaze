<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticsController extends Controller
{
	public function privacy()
	{
		$title = 'プライバシーポリシー';
		$route = ['url' => route('statics-menu'), 'title' => ' メニュー'];

		return view('statics.privacy', ['route' => $route, 'title' => $title]);
	}
	public function terms()
	{
		$title = 'ご利用規約';
		$route = ['url' => route('statics-menu'), 'title' => ' メニュー'];

		return view('statics.terms', ['route' => $route, 'title' => $title]);
	}
	public function menu()
	{
		if(Auth::user()->type=='trader')
		{
			$Trader = \App\Trader::where('user_id', Auth::id())->first();
			return view('statics.menu', ['trader' => $Trader]);
		}
		return view('statics.menu');
	}
}
