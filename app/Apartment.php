<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
	static $control = ['自主管理', '常駐管理', '日勤管理', '巡回管理', 'その他'];
	static $construction = ['鉄筋鉄骨コンクリート', '鉄筋コンクリート', '重量鉄骨', '軽量鉄骨', '木造'];
	static $facilities = ['機械式駐車場', '平面駐車場', 'エレベーター', 'オートロック式エントランス', '宅配ボックス'];
	// 一戸あたり積立累計 '年' => '円'
	static $reserve = [
		'30' => '5000000',
		'50' => '15000000'
	];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
	public function buildings()
	{
		return $this->hasMany('App\Building');
	}
	public function events($membership=0)
	{
		if($membership==1)
		{
			$date = date('Y-m-d H:i:s', strtotime('-3 year'));
		}
		else
		{
			$date = date('Y-m-d H:i:s', strtotime('-6 month'));
		}
		return $this->hasMany('App\Event')->where('created_at', '>', $date)->orderBy('schedule', 'desc');
	}
	public function ranks()
	{
		return $this->morphMany('App\Rank', 'rankable');
	}
	public function insurances()
	{
		return $this->hasMany('App\Insurance')->orderBy('sort_id', 'asc');
	}

	public function scored($Apartment)
	{
		$years = (int)(floor(time() - strtotime($Apartment->completion_date))/60/60/24/365);
		if($years < 30)
		{
			$per_reserved = $Apartment::reserve[30] / 30*$years;
			$Apartment->reserved = $per_reserved * $Apartment->total_units;
		}
		elseif($years > 30)
		{
			$per_reserved = ($years-30)*500000 + 5000000;
			$Apartment->reserved = $per_reserved * $Apartment->total_units;
		}
		return $Apartment;
	}
}
