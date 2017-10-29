<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class UsersController extends Controller
{
	public function create()
	{
		return view('users.create');
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
				['tel' => $tel, 'auth_token' => $auth_token]
			);
		}catch (Exception $e){
			echo "エラーが発生しました。戻るボタンを押して下さい。";
		}

		return redirect()->route('users-certificate', $User->id);
	}
	public function certificate($id)
	{
		$User = \App\User::find($id);
		return view('users.certificate', ['user' => $User]);
	}
	public function postCertificate(Request $request)
	{
		$id = $request->input('user_id');
		$auth_token = $request->input('user_auth_token');
		$type = $request->input('user_type');

		$User = \App\User::find($id);

		// authToken認証
		$certification = ($User->auth_token===$auth_token && time()-strtotime($User->created_at) <= 60*60*24);

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
		$User = \App\User::find($id);
		switch ($User->type){
			case 'officer':
				return view('users.add_officer', ['user' => $User]);
			break;
			case 'common':
			break;
		}
		return view('users.add');
	}
	public function postAdd(Request $request)
	{
		$all = $request->all();
//		$User = \App\User::find($all['user']['id']);
		$User = \App\User::find(4);
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
		$Apartment->save();
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
		return view('users.add_complete');
	}

	public function list()
	{
		$Users = \App\User::all();
		return view('users.list', ['users' => $Users]);
	}
	public function inviteForm()
	{
		return view('users.invite_form');
	}
	public function inviteComplete()
	{
		return view('users.invite_complete');
	}
	public function detail($id)
	{
		return view('users.detail');
	}
}
