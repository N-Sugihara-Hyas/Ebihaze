<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tel', 'auth_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	static $job = ['自営業', '会社役員', '会社員', '公務員', 'パートアルバイト', 'その他'];
	static $owned = ['owned' => 'オーナー', 'rent' => '借りている'];
	static $reside = ['residents' => '住民', 'rentout' => '貸している'];
	static $type_display = ['officer' => '理事長', 'app' => 'アプリ'];

	public function accounts($sort='desc')
	{
		return $this->hasMany('App\Account')->orderBy('schedule', $sort);
	}
	public function ranks()
	{
		return $this->hasMany('App\Rank');
	}
	public function apartments()
	{
		return $this->hasMany('App\Apartment');
	}
}
