<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
		return view('statics.menu');
	}
}
