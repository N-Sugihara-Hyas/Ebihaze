<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $guarded = ['id'];

	public function comments()
	{
		return $this->morphMany('App\Comment', 'commentable');
	}
	public function ranks()
	{
		return $this->morphMany('App\Rank', 'rankable');
	}
}
