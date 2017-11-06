<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
	public function ranks()
	{
		return $this->morphMany('App\Rank', 'rankable');
	}
}
