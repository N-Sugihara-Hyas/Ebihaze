<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlyersController extends Controller
{
	public function list()
	{
		$title = 'チラシ一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Flyers = \App\Flyer::all();
		// 拡張子確認
//		foreach($Flyers as &$flyer)
//		{
//			$path = asset("img/resources/flyer/$flyer->id");
//			$info = new \SplFileInfo($path);
//			$flyer->ext = $info->getExtension();
//		}

		return view('flyers.list', ['flyers' => $Flyers, 'title' => $title, 'route' => $route]);
	}
	public function postList(Request $request)
	{
		$User = Auth::user();
		$flyer_ids = (!empty($User->flyer_ids)) ? unserialize($User->flyer_ids) : [];
		$flyer_ids[] = $request->input('flyer_id');
		$User->flyer_ids = serialize($flyer_ids);
		$User->save();

		return redirect()->route('flyers-list');
	}
}
