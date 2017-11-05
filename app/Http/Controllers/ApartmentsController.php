<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Img;

class ApartmentsController extends Controller
{
	public function list()
	{
		$title = 'マンション一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Apartments = \App\User::find(Auth::id())->apartments;
		return view('apartments.list', ['apartments' => $Apartments, 'route' => $route, 'title' => $title]);
	}
	public function switch()
	{
		$title = 'マンション切り替え';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Apartments = \App\User::find(Auth::id())->apartments;
		return view('apartments.switch', ['apartments' => $Apartments, 'route' => $route, 'title' => $title]);
	}
	public function postSwitch(Request $request)
	{
		session(['apartment_id' => $request->input(('apartment_id'))]);
		return redirect()->route('events-list');
	}
	public function detail($id)
	{
		$title = 'マンション詳細';
		$route = ['url' => route('apartments-list'), 'title' => 'マンション一覧'];

		$Apartment = \App\Apartment::find($id);
		return view('apartments.detail', ['apartment' => $Apartment, 'route' => $route, 'title' => $title]);
	}
	public function edit($id)
	{
		$title = 'マンション情報編集';
		$route = ['url' => route('apartments-detail', $id), 'title' => 'マンション詳細'];

		$Apartment = \App\Apartment::find($id);
		$Apartment->facilities = unserialize($Apartment->facilities);
		$Apartment->insurance = unserialize($Apartment->insurance);
		return view('apartments.edit', ['apartment' => $Apartment, 'route' => $route, 'title' => $title]);
	}
	public function postEdit(Request $request)
	{
		$apartment = $request->input('apartment');
		$Apartment = \App\Apartment::find($apartment['id']);
		foreach($apartment as $name => $value)
		{
			if(is_array($value))$value = serialize($value);
			$Apartment->{$name} = $value;
		}
		$Apartment->save();
		if ($request->hasFile('apartment_icon'))
		{
			$icon = $request->file('apartment_icon');
			$icon = Img::make($icon);
			$icon->fit(240,240);
			$dir = public_path('img/resources/apartment/'.$Apartment->id);
			if(!is_dir($dir))
			{
				exec('mkdir -p '.$dir);
				exec('chmod -R 777 img/resources');
			}
			$icon->save($dir.'/icon');
		}
		return redirect()->route('apartments-detail', $apartment['id']);
	}
	public function rank()
	{
		$title = 'マンションランク一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Apartments = \App\Apartment::all();
		foreach($Apartments as $Apart)
		{
			$Apart->rank = $Apart->ranks()->avg('rate');
		}
		return view('apartments.rank', ['apartments' => $Apartments, 'route' => $route, 'title' => $title]);
	}
}
