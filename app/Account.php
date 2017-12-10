<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $fillable = [
		'amount', 'schedule', 'category', 'name', 'sub_id'
	];

	static $alert = [
		// 5%以上
		'A' => '推奨される額を上回っています',
		//-5%～5%
		'B' => '推奨される額の範囲です',
		//-5%以下
		'C' => '推奨される額と比べて下回っています'
	];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function apartment()
	{
		return $this->belongsTo('App\Apartment');
	}
}
