<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
		'comment_content', 'post_id', 'user_id',
	];

	public function post() 
	{
		return $this->belongsTo('App\Post', 'post_id');
	}
}
