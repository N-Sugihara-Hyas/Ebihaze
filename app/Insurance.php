<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
	public function apartments()
	{
		return $this->belongsToMany('App\Apartment');
	}
}
