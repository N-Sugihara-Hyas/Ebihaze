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

	public function suppliersName(Event $event)
	{
		$suppliers_ids = $event->suppliers;
		if(preg_match('/([1-9]+,?)+/', $suppliers_ids)){
			$suppliers_ids = explode(',', $suppliers_ids);
			$suppliers = [];
			foreach($suppliers_ids as $trader_id){
				$suppliers[] = \App\Trader::where('id', $trader_id)->value('name');
			}
			$event->suppliers = implode('/', $suppliers);
		}
		return $event;
	}
	public function partiesName(Event $event)
	{
		$parties_ids = $event->parties;
		if(preg_match('/([1-9]+,?)+/', $parties_ids)) {
			$parties_ids = explode(',', $parties_ids);
			$parties = [];
			foreach($parties_ids as $user_id){
				$parties[] = \App\User::where('id', $user_id)->value('nickname');
			}
			$event->parties = implode('/', $parties);
		}
		return $event;
	}
}
