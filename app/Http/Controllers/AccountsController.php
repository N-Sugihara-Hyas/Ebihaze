<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
	public function list()
	{
		$Accounts = \App\User::find(1)->accounts;
		return view('accounts.list', ['accounts' => $Accounts]);
	}
	public function edit()
	{
		return view('accounts.edit');
	}
}
