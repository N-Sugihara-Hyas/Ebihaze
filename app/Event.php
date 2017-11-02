<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $guarded = ['id'];
	static $category = [
		'管理業務' => ['修繕', '清掃', '保険', '町内会等', 'その他'],
		'イベント' => ['イベント'],
		'会議' => ['理事会', '総会', 'その他'],
		'共有' => ['連絡事項', 'その他'],
		'その他' => ['その他']
	];

	public function comments()
	{
		return $this->morphMany('App\Comment', 'commentable');
	}
	public function ranks()
	{
		return $this->morphMany('App\Rank', 'rankable');
	}
	public function apartment()
	{
		return $this->belongsTo('App\Apartment');
	}
}
