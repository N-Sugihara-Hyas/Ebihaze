<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticsController extends Controller
{
	public function privacy()
	{
		return view('statics.privacy');
	}
	public function terms()
	{
		return view('statics.terms');
	}
	public function menu()
	{
		return view('statics.menu');
	}
}
