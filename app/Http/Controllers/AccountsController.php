<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
	public function list()
	{
		$title = '残高一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Accounts = \App\User::find(1)->accounts;
		$total = 0;
		foreach ($Accounts as $ac)
		{
			$total += $ac->amount;
		}
		return view('accounts.list', ['accounts' => $Accounts, 'total' => $total, 'route' => $route, 'title' => $title]);
	}
	public function edit()
	{
		$title = '残高情報編集';
		$route = ['url' => route('accounts-list'), 'title' => '残高一覧'];

		return view('accounts.edit', ['route' => $route, 'title' => $title]);
	}
	public function postEdit(Request $request)
	{
		$id = $request->input('id');
		$schedule = $request->input('account_schedule');
		$category = $request->input('account_category');

		$Account = \App\Account::updateOrCreate(
			['id' => $id],
			['schedule' => $schedule, 'category' => $category]
		);

		return view('accounts.edit');
	}
}
