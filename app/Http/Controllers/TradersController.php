<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Img;
use Illuminate\Support\Facades\Auth;

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
	public function rank()
	{
		$title = '業者ランク';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Traders = \App\Trader::all();
		foreach($Traders as $Trader)
		{
			$Trader->rank = $Trader->ranks()->avg('rate');
		}

		return view('traders.rank', ['traders' => $Traders, 'route' => $route, 'title' => $title]);
	}
	public function add()
	{
		$title = '業者追加';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		// セレクトボックス表示用
		$Trader = new \App\Trader;

		return view('traders.add', ['route' => $route, 'title' => $title, 'trader' => $Trader]);
	}
	public function postAdd(Request $request)
	{
		$error_rules = [
			'formats' => [
				'trader.name' => 'required',
				'trader.password' => 'required|confirmed',
				'trader.tel' => 'required|regex:/^[0-9]+$/',
				'trader.address' => 'required',
				'trader.area' => 'required',
				'trader_icon' => 'image'
			],
			'messages' => [
				'trader.name.required' => '業者名を入力して下さい',
				'trader.password.required' => 'パスワードを入力して下さい',
				'trader.password.confirmed' => 'パスワードが一致しません',
				'trader.tel.required' => '電話番号を入力して下さい',
				'trader.tel.regex' => '電話番号は数字のみで入力して下さい',
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
		// パスワード登録
		$password = $request->input('trader.password');

		$Trader = new \App\Trader;
		$Trader->name = $trader_name;
		$Trader->tel = $trader_tel;
		$Trader->address = $trader_address;
		$Trader->area = $trader_area;
		$Trader->introduction = $trader_introduction;

		$User = \App\User::updateOrCreate(
			['tel' => $trader_tel],
			['tel' => $trader_tel, 'name' => $trader_name, 'nickname' => $trader_name, 'password' => bcrypt($password)]
		);
		$User->type = 'trader';
		$User->owned = 'trader';
		$User->reside = 'trader';
		$User->trader = 'trader';
		$User->approval = 1;
		$User->save();

		$Trader->user_id = $User->id;
		$Trader->save();

		$this->saveImage('trader', $Trader->id);
//		if ($request->hasFile('trader_icon'))
//		{
//			$icon = $request->file('trader_icon');
//			$icon = Img::make($icon);
//			$icon->fit(240,240);
//			$dir = public_path('img/resources/trader/'.$Trader->id);
//			if(!is_dir($dir))
//			{
//				exec('mkdir -p '.$dir);
//				exec('chmod -R 777 img/resources');
//			}
//			$icon->save($dir.'/icon');
//		}

		return redirect()->route('traders-list');
	}
	public function detail($id)
	{
		$title = '業者詳細';
		if(Auth::user()->membership==1)
		{
			$route = ['url' => route('traders-rank'), 'title' => '業者ランク'];
		}
		else
		{
			$route = ['url' => route('traders-list'), 'title' => '業者一覧'];
		}

		$Trader = \App\Trader::find($id);
		$Trader->rank = $Trader->ranks()->avg('rate');
		// 担当アパート成型
		$Events = \App\Event::all();
		$apartment_ids = [];
		foreach($Events as $event)
		{
			if(in_array($id, explode(',', $event->suppliers)))
			{
				$apartment_ids[] = $event->apartment_id;
			}
		}
		$apartment_names = [];
		if(!empty($apartment_ids))
		{
			$Apartments = \App\Apartment::whereIn('id', $apartment_ids)->get();
			foreach($Apartments as $apart)
			{
				$apartment_names[] = $apart->name;
			}
		}
		$apartment_names = implode(',', $apartment_names);

//		$apartment_names = \App\Apartment::whereIn('id', $apartment_ids)->value('name')->get();
		return view('traders.detail', ['trader' => $Trader, 'route' => $route, 'title' => $title, 'apartment_names' => $apartment_names]);
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
				'trader.tel' => 'required|regex:/^[0-9]+$/',
				'trader.address' => 'required',
				'trader.area' => 'required',
				'trader_icon' => 'image'
			],
			'messages' => [
				'trader.name.required' => '業者名を入力して下さい',
				'trader.tel.required' => '電話番号を入力して下さい',
				'trader.tel.regex' => '電話番号は数字のみで入力して下さい',
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

		$this->saveImage('trader', $Trader->id);
//		if ($request->hasFile('trader_icon'))
//		{
//			$icon = $request->file('trader_icon');
//			$icon = Img::make($icon);
//			$icon->fit(240,240);
//			$dir = public_path('img/resources/trader/'.$Trader->id);
//			if(!is_dir($dir))
//			{
//				exec('mkdir -p '.$dir);
//				exec('chmod -R 777 img/resources');
//			}
//			$icon->save($dir.'/icon');
//		}

		return redirect()->route('traders-list');
	}

	/*
	 * $model_name : str : アイコン名
	 * $model_id : int : {Model}Id
	 */
	public function saveImage($model_name, $model_id)
	{
		if(!is_null($_FILES[$model_name."_icon"]["tmp_name"]))
		{
			$file_tmp  = $_FILES[$model_name."_icon"]["tmp_name"];
			$file_tmp = Img::make($file_tmp);
			$file_tmp->fit(240,240);
			// 正式保存先ファイルパス
			$dir = public_path("img/resources/$model_name/$model_id");
			if(!is_dir($dir))
			{
				exec('mkdir -p '.$dir);
				exec('chmod -R 777 img/resources');
			}
			// ファイル移動
			$result = @$file_tmp->save($dir.'/icon');
		}
	}
}
