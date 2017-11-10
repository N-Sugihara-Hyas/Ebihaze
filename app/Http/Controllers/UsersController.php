<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
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
		$tel = $request->input('user_tel');

		// SMS認証
		$twillioController = app()->make('\App\Http\Controllers\TwillioController');
		try{
			$auth_token = $twillioController->create($tel, 'num');

			$User = \App\User::updateOrCreate(
				['tel' => $tel],
				['tel' => $tel, 'auth_token' => $auth_token, 'password' => bcrypt('secret')]
			);
		}catch (Exception $e){
			echo "エラーが発生しました。戻るボタンを押して下さい。";
		}

		return redirect()->route('users-certificate', $User->id);
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
		$auth_token = $request->input('user_auth_token');
		$type = $request->input('user_type');
		// 権限分け
		$type = (strlen($auth_token)==8) ? 'common' : $type;

		$User = \App\User::find($id);

		// authToken認証
		$certification = ($User->auth_token===$auth_token && time()-strtotime($User->updated_at) <= 60*60*24);

		$User->certification = $certification;
		$User->type = $type;
		$User->save();

		if($certification)
		{
			return redirect()->route('users-add', $id);
		}
		else
		{
			$request->session()->flash('error', '認証が取れませんでした。再度、認証コードを取得下さい。');
			return redirect()->route('users-create');
		}
	}
	public function add($id)
	{
		$title = 'ユーザー登録';

		$User = \App\User::find($id);
		// セレクト項目表示用
		$Apartment = new \App\Apartment;
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
		$owned = array_keys(\App\User::$owned);
		switch ($type)
		{
			case 'officer':
				$error_rules = [
					'formats' => [
						'user.nickname' => 'required',
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
						'apartment_icon' => 'image'
					],
					'messages' => [
						'user.nickname.required' => 'ニックネームを入力して下さい',
						'room.room_number.required' => '部屋番号を入力して下さい',
						'user.owned.in' => '所有形態はいずれかをお選び下さい',
				'user.gender.in' => '性別はいずれかをお選び下さい',
						'user.birthday.numeric' => '生まれ年は半角数字で入力下さい',
						'user.job.in' => '職業はいずれかをお選び下さい',
						'apartment.name.required' => 'マンション名は必須です',
						'apartment.address.required' => 'マンション住所を入力下さい',
						'apartment.control.in' => '管理形態はいずれかをお選び下さい',
						'apartment.construction.in' => '構造はいずれかをお選び下さい',
						'apartment.total_units.numeric' => '総戸数は半角数字で入力して下さい',
						'apartment_icon.image' => '画像登録は画像のみとなります'
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
		$User = \App\User::find($all['user']['id']);
		$Apartment = new \App\Apartment;
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
		$Apartment->user_id = $User->id;
		$Apartment->public = 1;
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
		if ($request->hasFile('user_icon'))
		{
			$icon = $request->file('user_icon');
			$icon = Img::make($icon);
			$icon->fit(240,240);
			$dir = public_path('img/resources/user/'.$User->id);
			if(!is_dir($dir))
			{
				exec('mkdir -p '.$dir);
				exec('chmod -R 777 img/resources');
			}
			$icon->save($dir.'/icon');
		}
		$Building->apartment_id = $Apartment->id;
		$Building->save();
		$Room->building_id = $Building->id;
		$Room->save();
		$User->approval = 1;
		$User->apartment_id = $Apartment->id;
		$User->building_id = $Building->id;
		$User->room_id = $Room->id;
		$User->save();
		return redirect()->route('users-add-complete');
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

		$Users = \App\User::all();
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
		$tel = $request->input('user_tel');
		$User = \App\User::updateOrCreate(
			['tel' => $tel],
			['tel' => $tel, 'password' => bcrypt('secret')]
		);

		// SMS認証
		$twillioController = app()->make('\App\Http\Controllers\TwillioController');
		try{
			$auth_token = $twillioController->invite($tel, 'str', $User->id);

			$User->auth_token = $auth_token;
			$User->save();
		}catch (Exception $e){
			echo "エラーが発生しました。戻るボタンを押して下さい。";
		}

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
}
