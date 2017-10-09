<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
	public function list()
	{
		return view('events.list');
	}
	public function add()
	{
		return view('events.add');
	}
	public function detail($id)
	{
		return view('events.detail');
	}
}
