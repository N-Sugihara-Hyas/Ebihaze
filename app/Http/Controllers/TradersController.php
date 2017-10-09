<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradersController extends Controller
{
	public function list()
	{
		return view('traders.list');
	}
	public function add()
	{
		return view('traders.add');
	}
	public function detail($id)
	{
		return view('traders.detail');
	}
}
