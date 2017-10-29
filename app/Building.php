<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
	public function apartment()
	{
		return $this->belongsTo('App\Apartment');
	}
	public function rooms()
	{
		return $this->hasMany('App\Room');
	}
}
