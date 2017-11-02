<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	static $alert = [
		'5%以上' => '推奨される額を上回っています',
		'-5%～5%' => '推奨される額の範囲です',
		'-5%以下' => '推奨される額と比べて下回っています'
	];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
