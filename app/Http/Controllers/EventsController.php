<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
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
	public function message($id)
	{
		return view('events.message');
	}
	public function review($id)
	{
		return view('events.review');
	}
}
