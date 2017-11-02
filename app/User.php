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

	public function accounts()
	{
		return $this->hasMany('App\Account')->orderBy('schedule');
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
