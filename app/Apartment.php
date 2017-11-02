<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
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
		return $this->hasMany('App\Event');
	}
}
