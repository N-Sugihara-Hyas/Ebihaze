<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
	public function list()
	{
		return view('event.list');
	}
	public function add()
	{
		return view('event.add');
	}
	public function detail($id)
	{
		return view('event.detail');
	}
}
