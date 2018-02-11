<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
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
	public function add()
	{
		$title = 'マンション情報登録';
		$route = ['url' => route('apartments-list'), 'title' => 'マンション一覧'];

		// suggest表示用
		$Apartment = \App\Apartment::all();
		$names = [];
		foreach ($Apartment as $apart)
		{
			$names[] = "'".$apart->name."'";
		}
		// セレクト項目表示用
		$Apartment = new \App\Apartment;
		$Apartment->names = implode(',', $names);

		return view('apartments.add', ['apartment' => $Apartment, 'route' => $route, 'title' => $title]);
	}
	public function postAdd(Request $request)
	{
		$error_rules = [
			'formats' => [
				'apartment.name' => 'required',
				'apartment.address' => 'required',
				'apartment.control' => 'in:'.implode(',', \App\Apartment::$control),
				'apartment.construction' => 'in:'.implode(',', \App\Apartment::$construction),
				'apartment.total_units' => 'numeric',
				'apartment_icon' => 'image'
			],
			'messages' => [
				'apartment.name.required' => 'マンション名を入力して下さい',
				'apartment.address.required' => 'マンション住所を入力して下さい',
				'apartment.control.in' => '管理形態はいずれかをお選び下さい',
				'apartment.construction.in' => '構造はいずれかをお選び下さい',
				'apartment.total_units.numeric' => '総戸数半角数字で入力して下さい',
				'apartment_icon.image' => '画像登録は画像のみとなります'
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);
		$apartment = $request->input('apartment');
		// 竣工年月
		$apartment['completion_date'] = $apartment['completion_date--year'].$apartment['completion_date--month'];
		unset($apartment['completion_date--year']);
		unset($apartment['completion_date--month']);

		// 更新か上書きかを名前と住所で判断
		$Apartment = \App\Apartment::where('name', 'LIKE', $apartment['name'])->where('address', 'LIKE', $apartment['address'])->first();
		$Apartment = ($Apartment) ? $Apartment : new \App\Apartment;
//		$Apartment = new \App\Apartment;

		foreach($apartment as $name => $value)
		{
			if(is_array($value))$value = serialize($value);
			$Apartment->{$name} = $value;
		}
		// ユーザーID登録
		$Apartment->user_id = Auth::id();
		$Apartment->save();
		$this->saveImage('apartment', $Apartment->id);
//		if ($request->hasFile('apartment_icon'))
//		{
//			$icon = $request->file('apartment_icon');
//			$icon = Img::make($icon);
//			$icon->fit(240,240);
//			$dir = public_path('img/resources/apartment/'.$Apartment->id);
//			if(!is_dir($dir))
//			{
//				exec('mkdir -p '.$dir);
//				exec('chmod -R 777 img/resources');
//			}
//			$icon->save($dir.'/icon');
//		}
		// 保険登録
		$insurances = $request->input('insurance');
		foreach($insurances as $num => $ins)
		{
//			if(!empty($ins['name']) && !empty($ins['expired']))
//			{
			$Insurance = \App\Insurance::where('sort_id', $num)->where('apartment_id', $Apartment->id)->first();
			$Insurance = ($Insurance) ? $Insurance : new \App\Insurance;
			$Insurance->name = $ins['name'];
			$Insurance->expired = $ins['expired'];
			$Insurance->apartment_id = $Apartment->id;
			$Insurance->sort_id = $num;
			$Insurance->save();
//			}
		}
		return redirect()->route('apartments-list');
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
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$Apartment = \App\Apartment::find($id);
		$Apartment->rank = $Apartment->ranks()->avg('rate');
		$insurances_name = [];
		foreach ($Apartment->insurances as $ins)
		{
			if($ins->name)$insurances_name[] = $ins->name;
		}
		$Apartment->insurances_name = implode(',', $insurances_name);
		return view('apartments.detail', ['apartment' => $Apartment, 'route' => $route, 'title' => $title]);
	}
	public function edit($id)
	{
		$title = 'マンション情報編集';
		$route = ['url' => route('apartments-detail', $id), 'title' => 'マンション詳細'];

		$Apartment = \App\Apartment::find($id);
		// suggest表示用
		$Apartments = \App\Apartment::all();
		$names = [];
		foreach ($Apartments as $apart)
		{
			$names[] = "'".$apart->name."'";
		}
		// セレクト項目表示用
		$Apartment->names = implode(',', $names);
		$Apartment->facilities = unserialize($Apartment->facilities);
//		$Apartment->insurance = unserialize($Apartment->insurance);
		$Insurance = \App\Insurance::whereApartmentId($id)->get()->toArray();
		$NewInsurance = ['name' => null, 'expired' => null];
		$insurances = array_fill(0, 5, $NewInsurance);
		$insurances = $Insurance + $insurances;
		$Apartment->insurances_array = $insurances;

		return view('apartments.edit', ['apartment' => $Apartment, 'route' => $route, 'title' => $title]);
	}
	public function postEdit(Request $request)
	{
		$error_rules = [
			'formats' => [
				'apartment.name' => 'required',
				'apartment.address' => 'required',
				'apartment.control' => 'in:'.implode(',', \App\Apartment::$control),
				'apartment.construction' => 'in:'.implode(',', \App\Apartment::$construction),
				'apartment.total_units' => 'numeric',
				'apartment_icon' => 'image'
			],
			'messages' => [
				'apartment.name.required' => 'マンション名を入力して下さい',
				'apartment.address.required' => 'マンション住所を入力して下さい',
				'apartment.control.in' => '管理形態はいずれかをお選び下さい',
				'apartment.construction.in' => '構造はいずれかをお選び下さい',
				'apartment.total_units.numeric' => '総戸数は半角数字で入力して下さい',
				'apartment_icon.image' => '画像登録は画像のみとなります'
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);
		$apartment = $request->input('apartment');
		// 竣工年月
		$apartment['completion_date'] = $apartment['completion_date--year'].$apartment['completion_date--month'];
		unset($apartment['completion_date--year']);
		unset($apartment['completion_date--month']);
		$Apartment = \App\Apartment::find($apartment['id']);
		foreach($apartment as $name => $value)
		{
			if(is_array($value))$value = serialize($value);
			$Apartment->{$name} = $value;
		}
		$Apartment->save();
		$this->saveImage('apartment', $Apartment->id);
//		if ($request->hasFile('apartment_icon'))
//		{
//			$icon = $request->file('apartment_icon');
//			$icon = Img::make($icon);
//			$icon->fit(240,240);
//			$dir = public_path('img/resources/apartment/'.$Apartment->id);
//			if(!is_dir($dir))
//			{
//				exec('mkdir -p '.$dir);
//				exec('chmod -R 777 img/resources');
//			}
//			$icon->save($dir.'/icon');
//		}
		// 保険登録
		$insurances = $request->input('insurance');
		foreach($insurances as $num => $ins)
		{
//			if(!empty($ins['name']) && !empty($ins['expired']))
//			{
				$Insurance = \App\Insurance::where('sort_id', $num)->where('apartment_id', $Apartment->id)->first();
				$Insurance = ($Insurance) ? $Insurance : new \App\Insurance;
				$Insurance->name = $ins['name'];
				$Insurance->expired = $ins['expired'];
				$Insurance->apartment_id = $Apartment->id;
				$Insurance->sort_id = $num;
				$Insurance->save();
//			}
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
