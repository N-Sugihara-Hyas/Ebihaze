<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentsController extends Controller
{
	public function list()
	{
		$Apartments = \App\User::find(Auth::id())->apartments;
		return view('apartments.list', ['apartments' => $Apartments]);
	}
	public function detail($id)
	{
		$Apartment = \App\Apartment::find($id);
		return view('apartments.detail', ['apartment' => $Apartment]);
	}
	public function edit($id)
	{
		$Apartment = \App\Apartment::find($id);
		return view('apartments.detail', ['apartment' => $Apartment]);
	}
	public function rank()
	{
		$Apartments = \App\Apartment::all();
		return view('apartments.rank', ['apartments' => $Apartments]);
	}
}
