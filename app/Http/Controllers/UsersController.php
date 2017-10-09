<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
	public function list()
	{
		return view('users.list');
	}
	public function inviteForm()
	{
		return view('users.invite_form');
	}
	public function inviteComplete()
	{
		return view('users.invite_complete');
	}
	public function detail($id)
	{
		return view('users.detail');
	}
}
