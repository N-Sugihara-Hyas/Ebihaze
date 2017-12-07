<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
	static $control = ['自主管理', '常駐管理', '日勤管理', '巡回管理', 'その他'];
	static $construction = ['鉄筋鉄骨コンクリート', '鉄筋コンクリート', '重量鉄骨', '軽量鉄骨', '木造'];
	static $facilities = ['機械式駐車場', '平面駐車場', 'エレベーター', 'オートロック式エントランス', '宅配ボックス'];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
	public function buildings()
	{
		return $this->hasMany('App\Building');
	}
	public function events()
	{
		return $this->hasMany('App\Event')->orderBy('schedule', 'desc');
	}
	public function ranks()
	{
		return $this->morphMany('App\Rank', 'rankable');
	}
	public function insurances()
	{
		return $this->hasMany('App\Insurance')->orderBy('schedule', 'asc');
	}
}
