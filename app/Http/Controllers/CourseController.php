<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Post;
use App\Comment;
use App\Attachment;
use Auth;
use DB;

class CourseController extends Controller
{
	public function addCourse(Request $request)
	{
		$course_name = $request->course_name;
		$description = $request->description;
		$time_limit = $request->time_limit;
		$start_date = date('Y-m-d H:i:s');
		$end_date = date('Y-m-d H:i:s',strtotime("+".$time_limit." minutes", strtotime($start_date)));

		Course::create([
			'user_id' => Auth::User()->id,
			'course_name' => $course_name,
			'description' => $description,
			'start_date' => $start_date,
			'end_date' => $end_date,
		]);

		return back()->with('success', 'Created new course');
	}

	public function courseDetailPage($id)
	{
		$posts = Post::with(['comments' => function($query){
			$query->select('u.name', 'u.photo', 'comments.*')->join('users as u', 'u.id', '=', 'comments.user_id');
		}])->with('attachments')->with('dosen')->where('posts.course_id', '=', $id)->orderBy('posts.created_at', 'desc')->get();

		// return response()->json($posts);
		return view('course', ['posts' => $posts, 'course_id' => $id]);
	}

	public function postContent(Request $request)
	{
		// var_dump($request->all());
		$post = new Post;

		$post->post_content = $request->post_content;
		$post->user_id = Auth::User()->id;
		$post->course_id = $request->course_id;
		$post->save();

		$files = $request->file('attachment');
		if ($request->hasFile('attachment'))
		{
			foreach ($files as $file) {
				$attachment = new Attachment;
			// print_r($file);
				$filename = $file->getClientOriginalName();

				$file->move(public_path(). '/file/'.Auth::User()->id.'/', $filename);
				$attachment->url = '/file/'.Auth::User()->id.'/'.$filename;
				$attachment->file = $filename;
				$attachment->save();

				$post_attach_data = ['post_id' => $post->id, 'attachment_id' => $attachment->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];

				DB::table('post_attachment')->insert($post_attach_data);
			}
		}

		return back();
	}

	public function addNewAttachment(Request $request)
	{
		$files = $request->file('attachment');

		foreach ($files as $file) {
			$attachment = new Attachment;
			// print_r($file);
			$filename = $file->getClientOriginalName();
			
			$file->move(public_path(). '/file/'.Auth::User()->id.'/', $filename);
			$attachment->url = '/file/'.Auth::User()->id.'/'.$filename;
			$attachment->file = $filename;
			$attachment->save();

			$post_attach_data = ['post_id' => $request->post_id, 'attachment_id' => $attachment->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];

			DB::table('post_attachment')->insert($post_attach_data);

			return back();
		}
	}

	public function addComment(Request $request)
	{
		$comment = new Comment;
		$comment->comment_content = $request->comment_content;
		$comment->post_id = $request->post_id;
		$comment->user_id = Auth::User()->id;
		$comment->save();

		return back();
	}

	public function destroyPost($id)
	{
		$post = Post::findOrFail($id);
		$post->delete();

		return back();
	}

	public function destroyFile(Request $request,$id)
	{
		DB::table('post_attachment')->where('attachment_id', $id)->where('post_id', $request->post_id)->delete();
		
		return back();
	}

	public function destroyComment($id)
	{
		$comment = Comment::findOrFail($id);
		$comment->delete();

		return back();
	}

	public function updatePost(Request $request,$id)
	{
		$post = Post::findOrFail($id);
		$post->update($request->all());

		return back();
		// return response()->json($post);
	}

	public function update(Request $request,$id)
	{
		$course = Course::findOrFail($id);
		$course->update($request->all());

		return redirect()->route('index_page')->with('success', 'Course edited!');
	}

	public function destroy($id)
	{
		$course = Course::findOrFail($id);
		$course->delete();

		return redirect()->route('index_page');
	}
}
