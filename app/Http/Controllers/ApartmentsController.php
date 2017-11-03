<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentsController extends Controller
{
	public function list()
	{
		$title = 'マンション一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Apartments = \App\User::find(Auth::id())->apartments;
		return view('apartments.list', ['apartments' => $Apartments, 'route' => $route, 'title' => $title]);
	}
	public function switch()
	{
		$title = 'マンション切り替え';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Apartments = \App\User::find(Auth::id())->apartments;
		return view('apartments.switch', ['apartments' => $Apartments, 'route' => $route, 'title' => $title]);
	}
	public function postSwitch(Request $request)
	{
		session(['apartment_id' => $request->input(('apartment_id'))]);
		return redirect()->route('events-list');
	}
	public function detail($id)
	{
		$title = 'マンション詳細';
		$route = ['url' => route('apartments-list'), 'title' => 'マンション一覧'];

		$Apartment = \App\Apartment::find($id);
		return view('apartments.detail', ['apartment' => $Apartment, 'route' => $route, 'title' => $title]);
	}
	public function edit($id)
	{
		$title = 'マンション情報編集';
		$route = ['url' => route('apartments-detail', $id), 'title' => 'マンション詳細'];

		$Apartment = \App\Apartment::find($id);
		return view('apartments.detail', ['apartment' => $Apartment, 'route' => $route, 'title' => $title]);
	}
	public function rank()
	{
		$title = 'マンションランク一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Apartments = \App\Apartment::all();
		return view('apartments.rank', ['apartments' => $Apartments, 'route' => $route, 'title' => $title]);
	}
}
