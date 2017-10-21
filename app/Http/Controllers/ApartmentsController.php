<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
	public function list()
	{
		return view('apartments.list');
	}
	public function rank()
	{
		return view('apartments.rank');
	}
}
