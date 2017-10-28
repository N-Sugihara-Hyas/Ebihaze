<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
	public function list()
	{
		$Accounts = \App\User::find(1)->accounts;
		$total = 0;
		foreach ($Accounts as $ac)
		{
			$total += $ac->amount;
		}
		return view('accounts.list', ['accounts' => $Accounts, 'total' => $total]);
	}
	public function edit()
	{
		return view('accounts.edit');
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
