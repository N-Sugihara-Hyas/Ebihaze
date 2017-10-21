<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
	protected $fillable = ['rate', 'rankable_id', 'rankable_type'];
	/**
	 * 所有しているrankableモデルの全取得
	 */
	public function rankable()
	{
		return $this->morphTo();
	}
}
