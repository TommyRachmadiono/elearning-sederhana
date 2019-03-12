<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
	protected $fillable = [
		'comment_content', 'post_id',
	];

	public function post()
	{
		return $this->belongsToMany('App\Post');
	}
}
