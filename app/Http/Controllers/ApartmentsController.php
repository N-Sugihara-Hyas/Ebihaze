<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
	public function list()
	{
		$Apartments = \App\Apartment::all();
		return view('apartments.list', ['apartments' => $Apartments]);
	}
	public function rank()
	{
		$Apartments = \App\Apartment::all();
		return view('apartments.rank', ['apartments' => $Apartments]);
	}
}
