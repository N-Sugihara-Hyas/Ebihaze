<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
	public function list()
	{
		$title = '残高一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Account1 = \App\User::find(Auth::id())->accounts()->whereSubId(1)->get();
		$Account1->total = \App\User::find(Auth::id())->accounts()->whereSubId(1)->sum('amount');
		$Account2 = \App\User::find(Auth::id())->accounts()->whereSubId(2)->get();
		$Account2->total = \App\User::find(Auth::id())->accounts()->whereSubId(2)->sum('amount');
		$Account3 = \App\User::find(Auth::id())->accounts()->whereSubId(3)->get();
		$Account3->total = \App\User::find(Auth::id())->accounts()->whereSubId(3)->sum('amount');
		$Accounts = [$Account1, $Account2, $Account3];
		return view('accounts.list', ['accounts' => $Accounts, 'route' => $route, 'title' => $title]);
	}

	public function add()
	{
		$title = '残高情報追加';
		$route = ['url' => route('accounts-list'), 'title' => '残高一覧'];

		$Account1 = \App\User::find(Auth::id())->accounts()->whereSubId(1)->get();
		$Account1->total = \App\User::find(Auth::id())->accounts()->whereSubId(1)->sum('amount');
		$Account2 = \App\User::find(Auth::id())->accounts()->whereSubId(2)->get();
		$Account2->total = \App\User::find(Auth::id())->accounts()->whereSubId(2)->sum('amount');
		$Account3 = \App\User::find(Auth::id())->accounts()->whereSubId(3)->get();
		$Account3->total = \App\User::find(Auth::id())->accounts()->whereSubId(3)->sum('amount');
		$Accounts = [$Account1, $Account2, $Account3];

		return view('accounts.add', ['accounts' => $Accounts, 'route' => $route, 'title' => $title]);
	}

	public function postAdd(Request $request)
	{
		$amount = $request->input('account_amount');
		$schedule = $request->input('account_schedule');
		$category = $request->input('account_category');
		$sub_id = $request->input('account_sub_id');

		$Account = new \App\Account;
		// TODO::Account:Name
//		$Account->name = '口座'.$sub_id;
		$Account->amount = $amount;
		$Account->schedule = $schedule;
		$Account->category = $category;
		$Account->user_id = Auth::id();
		$Account->sub_id = $sub_id;
		$Account->save();

		return redirect()->route('accounts-list');
	}

	public function edit($id)
	{
		$title = '残高情報編集';
		$route = ['url' => route('accounts-list'), 'title' => '残高一覧'];

		$Account = \App\Account::find($id);
		$Account->total = \App\User::find(Auth::id())->accounts()->whereSubId($Account->sub_id)->sum('amount');

		return view('accounts.edit', ['account' => $Account, 'route' => $route, 'title' => $title]);
	}

	public function postEdit(Request $request)
	{
		$id = $request->input('account_id');
		$amount = $request->input('account_amount');
		$schedule = $request->input('account_schedule');
		$category = $request->input('account_category');

		$Account = \App\Account::updateOrCreate(
			['id' => $id],
			['schedule' => $schedule, 'category' => $category, 'amount' => $amount]
		);

		return redirect()->route('accounts-list');
	}
}
