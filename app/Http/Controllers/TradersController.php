<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradersController extends Controller
{
	public function list()
	{
		$title = '業者一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Traders = \App\Trader::all();
		return view('traders.list', ['traders' => $Traders, 'route' => $route, 'title' => $title]);
	}
	public function add()
	{
		$title = '業者追加';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		return view('traders.add', ['route' => $route, 'title' => $title]);
	}
	public function detail($id)
	{
		$title = '業者詳細';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Trader = \App\Trader::find($id);
		return view('traders.detail', ['trader' => $Trader, 'route' => $route, 'title' => $title]);
	}
}
