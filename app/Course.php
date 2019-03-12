<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $fillable = [
		'course_name', 'description', 'start_date', 'end_date', 'user_id',
	];

	public function dosen() 
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
