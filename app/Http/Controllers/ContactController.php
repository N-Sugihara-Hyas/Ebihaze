<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
	public function index()
	{
		$title = 'お問い合わせ';
		$route = ['url' => route('statics-menu'), 'title' => ' メニュー'];

		return view('contact.top', ['route' => $route, 'title' => $title]);
	}
}
