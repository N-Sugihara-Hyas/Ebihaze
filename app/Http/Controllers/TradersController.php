<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradersController extends Controller
{
	public function list()
	{
		$Traders = \App\Trader::all();
		return view('traders.list', ['traders' => $Traders]);
	}
	public function add()
	{
		return view('traders.add');
	}
	public function detail($id)
	{
		$Trader = \App\Trader::find($id);
		return view('traders.detail', ['trader' => $Trader]);
	}
}
