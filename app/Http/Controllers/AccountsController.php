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

		// 1. 修繕積立金
		$Account1 = \App\User::find(Auth::id())->accounts('desc')->whereSubId(1)->get();
		// 現残高プロパティ
		$Account1->total = @$Account1[0]->amount;
		// 差額計算用
		$diff_Account1 = \App\User::find(Auth::id())->accounts('asc')->whereSubId(1)->get()->toArray();
		// 差額計算結果配列
		$diffs = [];
		foreach ($diff_Account1 as $times => $dac1)
		{
			if($times==0)
			{
				$diffs[] = $dac1['amount'];
			}
			if($times!=0)
			{
				$diffs[] = $dac1['amount'] - $diff_Account1[$times-1]['amount'];
			}
		}
		// Desc へソート
		$diffs = array_reverse($diffs);
		// 計算結果へ置き換え
		foreach ($Account1 as $times => &$ac1)
		{
			$ac1->amount = $diffs[$times];
		}

		// 2. 管理費
		$Account2 = \App\User::find(Auth::id())->accounts('desc')->whereSubId(2)->get();
		// 現残高プロパティ
		$Account2->total = @$Account2[0]->amount;
		// 差額計算用
		$diff_Account2 = \App\User::find(Auth::id())->accounts('asc')->whereSubId(2)->get()->toArray();
		// 差額計算結果配列
		$diffs = [];
		foreach ($diff_Account2 as $times => $dac2)
		{
			if($times==0)
			{
				$diffs[] = $dac2['amount'];
			}
			if($times!=0)
			{
				$diffs[] = $dac2['amount'] - $diff_Account2[$times-1]['amount'];
			}
		}
		// Desc へソート
		$diffs = array_reverse($diffs);
		// 計算結果へ置き換え
		foreach ($Account2 as $times => &$ac2)
		{
			$ac2->amount = $diffs[$times];
		}

		// 3. その他
		$Account3 = \App\User::find(Auth::id())->accounts('desc')->whereSubId(3)->get();
		// 現残高プロパティ
		$Account3->total = @$Account3[0]->amount;
		// 差額計算用
		$diff_Account3 = \App\User::find(Auth::id())->accounts('asc')->whereSubId(3)->get()->toArray();
		// 差額計算結果配列
		$diffs = [];
		foreach ($diff_Account3 as $times => $dac3)
		{
			if($times==0)
			{
				$diffs[] = $dac3['amount'];
			}
			if($times!=0)
			{
				$diffs[] = $dac3['amount'] - $diff_Account3[$times-1]['amount'];
			}
		}
		// Desc へソート
		$diffs = array_reverse($diffs);
		// 計算結果へ置き換え
		foreach ($Account3 as $times => &$ac3)
		{
			$ac3->amount = $diffs[$times];
		}

		// 積立残高レンジ判定(1:修繕積立金のみ)
		$Apartment = \App\Apartment::find(session('apartment_id'));
		$Apartment = $Apartment->scored($Apartment);
		if($Account1->total/$Apartment->reserved >= 105)
		{
			$Account1->alert = \App\Account::$alert['A'];
		}
		elseif($Account1->total/$Apartment->reserved < 105 && $Account1->total/$Apartment->reserved > 95)
		{
			$Account1->alert = \App\Account::$alert['B'];
		}
		else
		{
			$Account1->alert = \App\Account::$alert['C'];
		}

		$Accounts = [$Account1, $Account2, $Account3];
		return view('accounts.list', ['accounts' => $Accounts, 'route' => $route, 'title' => $title]);
	}

	public function add()
	{
		$title = '残高情報追加';
		$route = ['url' => route('accounts-list'), 'title' => '残高一覧'];

		// 1. 修繕積立金
		$Account1 = \App\User::find(Auth::id())->accounts('desc')->whereSubId(1)->get();
		// 現残高プロパティ
		$Account1->total = @$Account1[0]->amount;
		// 差額計算用
		$diff_Account1 = \App\User::find(Auth::id())->accounts('asc')->whereSubId(1)->get()->toArray();
		// 差額計算結果配列
		$diffs = [];
		foreach ($diff_Account1 as $times => $dac1)
		{
			if($times==0)
			{
				$diffs[] = $dac1['amount'];
			}
			if($times!=0)
			{
				$diffs[] = $dac1['amount'] - $diff_Account1[$times-1]['amount'];
			}
		}
		// Desc へソート
		$diffs = array_reverse($diffs);
		// 計算結果へ置き換え
		foreach ($Account1 as $times => &$ac1)
		{
			$ac1->amount = $diffs[$times];
		}

		// 2. 管理費
		$Account2 = \App\User::find(Auth::id())->accounts('desc')->whereSubId(2)->get();
		// 現残高プロパティ
		$Account2->total = @$Account2[0]->amount;
		// 差額計算用
		$diff_Account2 = \App\User::find(Auth::id())->accounts('asc')->whereSubId(2)->get()->toArray();
		// 差額計算結果配列
		$diffs = [];
		foreach ($diff_Account2 as $times => $dac2)
		{
			if($times==0)
			{
				$diffs[] = $dac2['amount'];
			}
			if($times!=0)
			{
				$diffs[] = $dac2['amount'] - $diff_Account2[$times-1]['amount'];
			}
		}
		// Desc へソート
		$diffs = array_reverse($diffs);
		// 計算結果へ置き換え
		foreach ($Account2 as $times => &$ac2)
		{
			$ac2->amount = $diffs[$times];
		}

		// 3. その他
		$Account3 = \App\User::find(Auth::id())->accounts('desc')->whereSubId(3)->get();
		// 現残高プロパティ
		$Account3->total = @$Account3[0]->amount;
		// 差額計算用
		$diff_Account3 = \App\User::find(Auth::id())->accounts('asc')->whereSubId(3)->get()->toArray();
		// 差額計算結果配列
		$diffs = [];
		foreach ($diff_Account3 as $times => $dac3)
		{
			if($times==0)
			{
				$diffs[] = $dac3['amount'];
			}
			if($times!=0)
			{
				$diffs[] = $dac3['amount'] - $diff_Account3[$times-1]['amount'];
			}
		}
		// Desc へソート
		$diffs = array_reverse($diffs);
		// 計算結果へ置き換え
		foreach ($Account3 as $times => &$ac3)
		{
			$ac3->amount = $diffs[$times];
		}
		$Accounts = [$Account1, $Account2, $Account3];

		return view('accounts.add', ['accounts' => $Accounts, 'route' => $route, 'title' => $title]);
	}

	public function postAdd(Request $request)
	{
		$error_rules = [
			'formats' => [
				'account_amount' => 'required|numeric',
				'account_schedule' => 'required|date_format:Y/m/d',
				'account_category' => 'required',
			],
			'messages' => [
				'account_amount.required' => '金額を入力して下さい',
				'account_amount.numeric' => '金額を数字で入力して下さい',
				'account_schedule.required' => '日付を入力して下さい',
				'account_schedule.date_format' => '日付の形式が不正です',
				'account_category.required' => '項目を入力して下さい',
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);
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
		$Account->total = \App\User::find(Auth::id())->accounts()->whereSubId($Account->sub_id);
		$Account->total = @$Account->amount;

		return view('accounts.edit', ['account' => $Account, 'route' => $route, 'title' => $title]);
	}

	public function postEdit(Request $request)
	{
		$error_rules = [
			'formats' => [
				'account_amount' => 'required|numeric',
				'account_schedule' => 'required|date_format:Y/m/d',
				'account_category' => 'required',
			],
			'messages' => [
				'account_amount.required' => '金額を入力して下さい',
				'account_amount.numeric' => '金額を数字で入力して下さい',
				'account_schedule.required' => '日付を入力して下さい',
				'account_schedule.date_format' => '日付の形式が不正です',
				'account_category.required' => '項目を入力して下さい',
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);
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
