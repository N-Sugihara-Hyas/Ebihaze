<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Img;

class TradersController extends Controller
{
	public function list()
	{
		$title = '業者一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Traders = \App\Trader::all();
		foreach($Traders as $Trader)
		{
			$Trader->rank = $Trader->ranks()->avg('rate');
		}

		return view('traders.list', ['traders' => $Traders, 'route' => $route, 'title' => $title]);
	}
	public function add()
	{
		$title = '業者追加';
		$route = ['url' => route('traders-list'), 'title' => '業者一覧'];

		return view('traders.add', ['route' => $route, 'title' => $title]);
	}
	public function postAdd(Request $request)
	{
		$error_rules = [
			'formats' => [
				'trader.name' => 'required',
				'trader.tel' => 'required',
				'trader.address' => 'required',
				'trader.area' => 'required',
				'trader_icon' => 'image'
			],
			'messages' => [
				'trader.name.required' => '業者名を入力して下さい',
				'trader.tel.required' => '電話番号を入力して下さい',
				'trader.address.required' => '住所を入力して下さい',
				'trader.area.required' => 'サービス提供エリアを入力して下さい',
				'trader_icon.image' => '画像登録は画像のみとなります'
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);
		$trader_tel = $request->input('trader.tel');
		$trader_name = $request->input('trader.name');
		$trader_address = $request->input('trader.address');
		$trader_area = $request->input('trader.area');
		$trader_introduction = $request->input('trader.introduction');

		$Trader = new \App\Trader;
		$Trader->name = $trader_name;
		$Trader->tel = $trader_tel;
		$Trader->address = $trader_address;
		$Trader->area = $trader_area;
		$Trader->introduction = $trader_introduction;

		$User = \App\User::updateOrCreate(
			['tel' => $trader_tel],
			['tel' => $trader_tel, 'name' => $trader_name, 'password' => bcrypt('secret')]
		);
		$User->type = 'trader';
		$User->owned = 'trader';
		$User->reside = 'trader';
		$User->trader = 'trader';
		$User->approval = 1;
		$User->save();

		$Trader->user_id = $User->id;
		$Trader->save();

		if ($request->hasFile('trader_icon'))
		{
			$icon = $request->file('trader_icon');
			$icon = Img::make($icon);
			$icon->fit(240,240);
			$dir = public_path('img/resources/trader/'.$Trader->id);
			if(!is_dir($dir))
			{
				exec('mkdir -p '.$dir);
				exec('chmod -R 777 img/resources');
			}
			$icon->save($dir.'/icon');
		}

		return redirect()->route('traders-list');
	}
	public function detail($id)
	{
		$title = '業者詳細';
		$route = ['url' => route('traders-list'), 'title' => '業者一覧'];

		$Trader = \App\Trader::find($id);
		$Trader->rank = $Trader->ranks()->avg('rate');
		return view('traders.detail', ['trader' => $Trader, 'route' => $route, 'title' => $title]);
	}
	public function edit($id)
	{
		$title = '業者編集';
		$route = ['url' => route('traders-detail', $id), 'title' => '業者詳細'];

		$Trader = \App\Trader::find($id);
		$Trader->rank = $Trader->ranks()->avg('rate');
		return view('traders.edit', ['trader' => $Trader, 'route' => $route, 'title' => $title]);
	}
	public function postEdit(Request $request)
	{
		$error_rules = [
			'formats' => [
				'trader.name' => 'required',
				'trader.tel' => 'required',
				'trader.address' => 'required',
				'trader.area' => 'required',
				'trader_icon' => 'image'
			],
			'messages' => [
				'trader.name.required' => '業者名を入力して下さい',
				'trader.tel.required' => '電話番号を入力して下さい',
				'trader.address.required' => '住所を入力して下さい',
				'trader.area.required' => 'サービス提供エリアを入力して下さい',
				'trader_icon.image' => '画像登録は画像のみとなります'
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);
		$trader_id = $request->input('trader.id');
		$trader_tel = $request->input('trader.tel');
		$trader_name = $request->input('trader.name');
		$trader_address = $request->input('trader.address');
		$trader_area = $request->input('trader.area');
		$trader_introduction = $request->input('trader.introduction');

		$Trader = \App\Trader::find($trader_id);
		// 旧電話番号を先にユーザーから探して更新
		$User = \App\User::updateOrCreate(
			['tel' => $Trader->tel],
			['tel' => $trader_tel, 'name' => $trader_name, 'password' => bcrypt('secret')]
		);

		$Trader->name = $trader_name;
		$Trader->tel = $trader_tel;
		$Trader->address = $trader_address;
		$Trader->area = $trader_area;
		$Trader->introduction = $trader_introduction;
		$Trader->user_id = $User->id;

		$Trader->save();

		if ($request->hasFile('trader_icon'))
		{
			$icon = $request->file('trader_icon');
			$icon = Img::make($icon);
			$icon->fit(240,240);
			$dir = public_path('img/resources/trader/'.$Trader->id);
			if(!is_dir($dir))
			{
				exec('mkdir -p '.$dir);
				exec('chmod -R 777 img/resources');
			}
			$icon->save($dir.'/icon');
		}

		return redirect()->route('traders-list');
	}
}
