<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Img;

class UsersController extends Controller
{
	public function create()
	{
		$title = 'ユーザー作成';

		return view('users.create', ['title' => $title]);
	}
	public function postCreate(Request $request)
	{

        $error_rules = [
			'formats' => [
				'user_tel' => 'required|numeric'
			],
			'messages' => [
				'user_tel.required' => 'SMS番号を入力して下さい',
				'user_tel.numeric' => 'SMS番号は数字のみで入力して下さい'
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);

		$tel = $request->input('user_tel');
		$api_flg = $request->input('api_flg');
		
		// SMS認証
//		$twillioController = app()->make('\App\Http\Controllers\TwillioController');
		$aossmsController = app()->make('\App\Http\Controllers\AossmsController');
		try{
//			$auth_token = $twillioController->create($tel, 'num');
			$auth_token = $aossmsController->create($tel, 'num');
//			$auth_token = '1234';

			$User = \App\User::updateOrCreate(
				['tel' => $tel],
				['tel' => $tel, 'auth_token' => $auth_token, 'password' => bcrypt('secret')]
			);
			if($api_flg !== null && $api_flg === 1){
				// アプリ用にjson返却
				return self::rtnJson(0, $User->id);
			} else {
				return redirect()->route('users-certificate', $User->id);
			}

		}catch (Exception $e){
			echo "エラーが発生しました。戻るボタンを押して下さい。";
			
			if($api_flg !== null && $api_flg === 1){
				// アプリ用にjson返却
				return self::rtnJson(1);
			} else {
				return redirect()->route('users-certificate', $User->id);
			}
		}

		// return redirect()->route('users-certificate', $User->id);
	}
	public function rtnJson($result, $id=null)
	{
		$response = array();

		$response["result"] = $result;
		$response["id"] = $id;

		return response()->json($response, 200);
	}
	public function certificate($id)
	{
		$title = 'ユーザー認証';

		$User = \App\User::find($id);
		return view('users.certificate', ['user' => $User, 'title' => $title]);
	}
	public function postCertificate(Request $request)
	{
		$id = $request->input('user_id');
		$api_flg = $request->input('api_flg');
		$auth_token = $request->input('user_auth_token');
		$type = $request->input('user_type');
		// 権限分け
		$type = (strlen($auth_token)==8) ? 'common' : $type;

		$User = \App\User::find($id);

		// authToken認証
		$certification = ($User->auth_token===$auth_token && time()-strtotime($User->updated_at) <= 60*60*24);

		try{

			$User->certification = $certification;
			$User->type = $type;
			$User->save();

			if($certification)
			{
				if($api_flg !== null && $api_flg === 1){
					// アプリ用にjson返却
					return self::rtnJson(0);
				} else {
					return redirect()->route('users-add', $id);
				}
			}
			else
			{
				if($api_flg !== null && $api_flg === 1){
					// アプリ用にjson返却
					return self::rtnJson(1);
				} else {
					$request->session()->flash('error', '認証が取れませんでした。再度、認証コードを取得下さい。');
					return redirect()->route('users-create');

				}
			}
		}catch (Exception $e){
			self::rtnJson(1);
			$request->session()->flash('error', '認証が取れませんでした。再度、認証コードを取得下さい。');
			return redirect()->route('users-create');
		}
	}
	public function add($id)
	{
		$title = 'ユーザー登録';

		$User = \App\User::find($id);
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
		switch ($User->type){
			case 'officer':
				return view('users.add_officer', ['user' => $User, 'apartment' => $Apartment, 'title' => $title]);
				break;
			case 'app':
				return view('users.add_officer', ['user' => $User, 'apartment' => $Apartment, 'title' => $title]);
				break;
			case 'common':
				return view('users.add_common', ['user' => $User, 'apartment' => $Apartment, 'title' => $title]);
				break;
			default:
				return view('users.add_common', ['user' => $User, 'apartment' => $Apartment, 'title' => $title]);
				break;
		}
		return view('users.add_common');
	}
	public function postAdd(Request $request)
	{
		$type = $request->input('user.type');
		switch ($type)
		{
			case 'officer':
				$error_rules = [
					'formats' => [
						'user.nickname' => 'required',
						'user.password' => 'required|confirmed',
						'room.room_number' => 'required',
						'user.owned' => 'in:'.implode(',', array_keys(\App\User::$owned)),
						'user.gender' => 'in:1,2,9',
						'user.birthday' => 'numeric',
						'user.job' => 'in:'.implode(',', \App\User::$job),
						'apartment.name' => 'required',
						'apartment.address' => 'required',
						'apartment.control' => 'in:'.implode(',', \App\Apartment::$control),
						'apartment.construction' => 'in:'.implode(',', \App\Apartment::$construction),
						'apartment.total_units' => 'numeric',
						'apartment_icon' => 'image',
						'user_icon' => 'image'
					],
					'messages' => [
						'user.nickname.required' => 'ニックネームを入力して下さい',
						'user.password.required' => 'パスワードを入力して下さい',
						'user.password.confirmed' => 'パスワードが一致しません',
						'room.room_number.required' => '部屋番号を入力して下さい',
						'user.owned.in' => '所有形態はいずれかをお選び下さい',
						'user.gender.in' => '性別はいずれかをお選び下さい',
						'user.birthday.numeric' => '生まれ年は半角数字で入力下さい',
						'user.job.in' => '職業はいずれかをお選び下さい',
						'apartment.name.required' => 'マンション名を入力して下さい',
						'apartment.address.required' => 'マンション住所を入力して下さい',
						'apartment.control.in' => '管理形態はいずれかをお選び下さい',
						'apartment.construction.in' => '構造はいずれかをお選び下さい',
						'apartment.total_units.numeric' => '総戸数は半角数字で入力して下さい',
						'apartment_icon.image' => 'マンション画像登録は画像のみとなります',
						'user_icon.image' => 'ユーザー画像登録は画像のみとなります'
					]
				];
				break;
			case 'common':
				$error_rules = [
					'formats' => [
						'user.nickname' => 'required',
						'user.password' => 'required|confirmed',
						'room.room_number' => 'required',
						'user.gender' => 'in:1,2,9',
						'user.birthday' => 'numeric',
						'user.job' => 'in:'.implode(',', \App\User::$job)
					],
					'messages' => [
						'user.nickname.required' => 'ニックネームを入力して下さい',
						'user.password.required' => 'パスワードを入力して下さい',
						'user.password.confirmed' => 'パスワードが一致しません',
						'room.room_number.required' => '部屋番号を入力して下さい',
						'user.gender.in' => '性別はいずれかをお選び下さい',
						'user.birthday.numeric' => '生まれ年は半角数字で入力下さい',
						'user.job.in' => '職業はいずれかをお選び下さい'
					]
				];
				break;
			default:
				$error_rules = [
					'formats' => [
						'user.nickname' => 'required',
						'room.room_number' => 'required',
						'user.gender' => 'in:1,2,9',
						'user.birthday' => 'numeric',
						'user.job' => 'in:'.implode(',', \App\User::$job)
					],
					'messages' => [
						'user.nickname.required' => 'ニックネームを入力して下さい',
						'room.room_number.required' => '部屋番号を入力して下さい',
						'user.gender.in' => '性別はいずれかをお選び下さい',
						'user.birthday.numeric' => '生まれ年は半角数字で入力下さい',
						'user.job.in' => '職業はいずれかをお選び下さい'
					]
				];
				break;
		}
		$request->validate($error_rules['formats'], $error_rules['messages']);
		$all = $request->all();
		// 確認用を破棄と暗号化
		unset($all['user']['password_confirmation']);
		$all['user']['password'] = bcrypt($all['user']['password']);

		$User = \App\User::find($all['user']['id']);
		// officerのみ登録のパート
		if($type=='officer')
		{
			// 竣工年月
			$all['apartment']['completion_date'] = $all['apartment']['completion_date--year'].$all['apartment']['completion_date--month'];
			unset($all['apartment']['completion_date--year']);
			unset($all['apartment']['completion_date--month']);
			// 間取り
			$all['room']['floor_plan'] = $all['room']['floor_plan--num'].$all['room']['floor_plan--type'];
			unset($all['room']['floor_plan--num']);
			unset($all['room']['floor_plan--type']);
			// 更新か上書きかを名前と住所で判断
			$Apartment = \App\Apartment::where('name', 'LIKE', $all['apartment']['name'])->where('address', 'LIKE', $all['apartment']['address'])->first();
			$Apartment = ($Apartment) ? $Apartment : new \App\Apartment;
		}
		$Building = new \App\Building;
		$Room = new \App\Room;

		foreach($all as $model => $attributes)
		{
			switch ($model){
				case 'user':
					foreach($attributes as $attr => $val)
					{
						$User->{$attr} = $val;
					}
					break;
				case 'apartment':
					foreach($attributes as $attr => $val)
					{
						if(is_array($val))$val = serialize($val);
						$Apartment->{$attr} = $val;
					}
					break;
				case 'building':
					foreach($attributes as $attr => $val)
					{
						$Building->{$attr} = $val;
					}
					break;
				case 'room':
					foreach($attributes as $attr => $val)
					{
						$Room->{$attr} = $val;
					}
					break;
			}
		}
		// officerのみ登録のパート
		if($type=='officer')
		{
			$Apartment->user_id = $User->id;
			$Apartment->public = 1;
			$Apartment->save();
			$Building->apartment_id = $Apartment->id;
			$Building->save();
			$Room->building_id = $Building->id;
			$Room->save();
			$User->approval = 9;
			$User->apartment_id = $Apartment->id;
			$User->building_id = $Building->id;
			$User->room_id = $Room->id;
			$User->save();
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
		}
		elseif ($type=="common")
		{
			$Building->apartment_id = $User->apartment_id;
			$Building->save();
			$Room->building_id = $Building->id;
			$Room->save();
			$User->approval = 9;
//			$User->apartment_id = $Apartment->id;
			$User->building_id = $Building->id;
			$User->room_id = $Room->id;
			$User->save();
		}

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

		$this->saveImage('user', $User->id);
//		if ($request->hasFile('user_icon'))
//		{
//			$icon = $request->file('user_icon');
//			$icon = Img::make($icon);
//			$icon->fit(240,240);
//			$dir = public_path('img/resources/user/'.$User->id);
//			if(!is_dir($dir))
//			{
//				exec('mkdir -p '.$dir);
//				exec('chmod -R 777 img/resources');
//			}
//			$icon->save($dir.'/icon');
//		}

		// for app 180203
		$api_flg = $request->input('api_flg');
		if($api_flg !== null && $api_flg === 1){
			// アプリ用にjson返却
			return self::rtnJson(0);
		} else {
			return redirect()->route('users-add-complete');
		}
	}
	public function edit($id)
	{
		$title = 'ユーザー登録';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		$User = \App\User::find($id);
		// 部屋取得
		$Room = \App\Room::find(Auth()->user()->room_id);
		// suggest表示用
		$Apartment = \App\Apartment::all();
		foreach ($Apartment as $apart)
		{
			$names[] = "'".$apart->name."'";
		}
		// セレクト項目表示用
		$Apartment = new \App\Apartment;
		$Apartment->names = implode(',', $names);
		switch ($User->type){
			case 'officer':
				return view('users.edit_officer', ['user' => $User, 'apartment' => $Apartment, 'room' => $Room, 'title' => $title, 'route' => $route]);
				break;
			case 'app':
				return view('users.edit_officer', ['user' => $User, 'apartment' => $Apartment, 'room' => $Room, 'title' => $title, 'route' => $route]);
				break;
			case 'common':
				return view('users.edit_common', ['user' => $User, 'apartment' => $Apartment, 'room' => $Room, 'title' => $title, 'route' => $route]);
				break;
			default:
				return view('users.edit_common', ['user' => $User, 'apartment' => $Apartment, 'room' => $Room, 'title' => $title, 'route' => $route]);
				break;
		}
		return view('users.edit_common', ['user' => $User, 'apartment' => $Apartment, 'room' => $Room, 'title' => $title, 'route' => $route]);
	}
	public function postEdit(Request $request)
	{
		$type = $request->input('user.type');
		switch ($type)
		{
			case 'officer':
				$error_rules = [
					'formats' => [
						'user.nickname' => 'required',
						'user.gender' => 'in:1,2,9',
						'user.birthday' => 'numeric',
						'user.job' => 'in:'.implode(',', \App\User::$job),
						'user_icon' => 'image',
						'room.room_number' => 'required'
					],
					'messages' => [
						'user.nickname.required' => 'ニックネームを入力して下さい',
						'user.gender.in' => '性別はいずれかをお選び下さい',
						'user.birthday.numeric' => '生まれ年は半角数字で入力下さい',
						'user.job.in' => '職業はいずれかをお選び下さい',
						'user_icon.image' => 'ユーザー画像登録は画像のみとなります',
						'room.room_number.required' => '部屋番号を入力して下さい',
					]
				];
				break;
			case 'common':
				$error_rules = [
					'formats' => [
						'user.nickname' => 'required',
						'room.room_number' => 'required',
						'user.gender' => 'in:1,2,9',
						'user.birthday' => 'numeric',
						'user.job' => 'in:'.implode(',', \App\User::$job)
					],
					'messages' => [
						'user.nickname.required' => 'ニックネームを入力して下さい',
						'user.gender.in' => '性別はいずれかをお選び下さい',
						'user.birthday.numeric' => '生まれ年は半角数字で入力下さい',
						'user.job.in' => '職業はいずれかをお選び下さい',
						'room.room_number.required' => '部屋番号を入力して下さい',
					]
				];
				break;
			default:
				$error_rules = [
					'formats' => [
						'user.nickname' => 'required',
						'room.room_number' => 'required',
						'user.gender' => 'in:1,2,9',
						'user.birthday' => 'numeric',
						'user.job' => 'in:'.implode(',', \App\User::$job)
					],
					'messages' => [
						'user.nickname.required' => 'ニックネームを入力して下さい',
						'user.gender.in' => '性別はいずれかをお選び下さい',
						'user.birthday.numeric' => '生まれ年は半角数字で入力下さい',
						'user.job.in' => '職業はいずれかをお選び下さい',
						'room.room_number.required' => '部屋番号を入力して下さい',
					]
				];
				break;
		}
		$request->validate($error_rules['formats'], $error_rules['messages']);
		$all = $request->all();
		// 間取り
		$all['room']['floor_plan'] = $all['room']['floor_plan--num'].$all['room']['floor_plan--type'];
		unset($all['room']['floor_plan--num']);
		unset($all['room']['floor_plan--type']);
		$User = \App\User::find($all['user']['id']);
		// 部屋情報更新
		$Room = \App\Room::find(Auth::user()->room_id);
		foreach($all as $model => $attributes)
		{
			switch ($model){
				case 'user':
					foreach($attributes as $attr => $val)
					{
						$User->{$attr} = $val;
					}
					break;
				case 'room':
					foreach($attributes as $attr => $val)
					{
						$Room->{$attr} = $val;
					}
					break;
			}
		}
		$this->saveImage('user', $User->id);
//		if ($request->hasFile('user_icon'))
//		{
//			$icon = $request->file('user_icon');
//			$icon = Img::make($icon);
//			$icon->fit(240,240);
//			$dir = public_path('img/resources/user/'.$User->id);
//			if(!is_dir($dir))
//			{
//				exec('mkdir -p '.$dir);
//				exec('chmod -R 777 img/resources');
//			}
//			$icon->save($dir.'/icon');
//		}
//		$User->approval = 9;
		$User->save();
		// 部屋保存
		$Room->save();
		return redirect()->route('statics-menu');
	}

	public function addComplete()
	{
		$title = 'ユーザー登録完了';

		return view('users.add_complete', ['title' => $title]);
	}

	public function list()
	{
		$title = 'ユーザー一覧';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		// 該当するアパートメントのユーザー一覧
		if(session()->has('apartment_id'))
		{
			$Apartment = \App\Apartment::find(session('apartment_id'));
		}
		else
		{
			$Apartments = \App\User::find(Auth::id())->apartments;
			$Apartment = $Apartments[0];
		}
		$Users = \App\User::where('apartment_id', $Apartment->id)->get();
//		$Users = \App\User::all();
		return view('users.list', ['users' => $Users, 'route' => $route, 'title' => $title]);
	}
	public function inviteForm()
	{
		$title = 'ユーザー招待';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		return view('users.invite_form', ['route' => $route, 'title' => $title]);
	}
	public function postInviteForm(Request $request)
	{
		$error_rules = [
			'formats' => [
				'user_tel' => 'required|numeric'
			],
			'messages' => [
				'user_tel.required' => 'SMS番号を入力して下さい',
				'user_tel.numeric' => 'SMS番号は数字のみで入力して下さい'
			]
		];
		$request->validate($error_rules['formats'], $error_rules['messages']);

		$tel = $request->input('user_tel');
		// 選択中のアパート住人として登録
		$User = \App\User::updateOrCreate(
			['tel' => $tel],
			['tel' => $tel, 'password' => bcrypt('secret'), 'apartment_id' => session('apartment_id')]
		);

		// SMS認証
//		$twillioController = app()->make('\App\Http\Controllers\TwillioController');
		$aossmsController = app()->make('\App\Http\Controllers\AossmsController');
		try{
//			$auth_token = $twillioController->invite($tel, 'str', $User->id);
			$auth_token = $aossmsController->invite($tel, 'str', $User->id);
//			$auth_token = '1234';

			$User->auth_token = $auth_token;
			$User->save();
		}catch (Exception $e){
			echo "エラーが発生しました。戻るボタンを押して下さい。";
		}

		// 招待されたので本権限へ
		Auth()->user()->approval = 1;
		Auth()->user()->save();

		return redirect()->route('users-invite-complete', $User->id);
	}
	public function inviteComplete()
	{
		$title = 'ユーザー招待完了';
		$route = ['url' => route('statics-menu'), 'title' => 'メニュー'];

		return view('users.invite_complete', ['route' => $route, 'title' => $title]);
	}
	public function detail($id)
	{
		return view('users.detail');
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
			// 正式保存先ファイルパス
			$dir = public_path("img/resources/$model_name/$model_id");
			if(!is_dir($dir))
			{
				exec('mkdir -p '.$dir);
				exec('chmod -R 777 img/resources');
			}
			// ファイル移動
			$result = @move_uploaded_file($file_tmp, $dir.'/icon');
		}
	}
}
