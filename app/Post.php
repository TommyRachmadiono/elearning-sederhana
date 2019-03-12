<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
		'post_content', 'course_id', 'user_id',
	];

	public function course() 
	{
		return $this->belongsTo('App\Course', 'course_id');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment');
	}

	public function attachments()
    {
        return $this->belongsToMany('App\Attachment', 'post_attachment');
    }

    public function dosen()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
