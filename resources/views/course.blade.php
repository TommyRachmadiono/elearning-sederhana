@extends('template.master')

@section('content')

@foreach ($courses as $course)
<?php
	$day1 = date('Y-m-d H:i:s');
	$day1 = strtotime($day1);
	$day2 = $course->end_date;
	$day2 = strtotime($day2);
	$diffHours = round(($day2 - $day1) / 3600);
?>
@endforeach

@if (Auth::User()->role == 'dosen' && $diffHours > 0)

<div class="row mt-5">
	<div class="container">
		<form action="{{ route('post.store') }}" method="POST" style="width: 100%;" enctype="multipart/form-data">
			{{ csrf_field() }}
			
			<input type="hidden" name="course_id" value="{{ $course_id }}">
			<textarea class="form-control" rows="3" id="post_content" name="post_content" style="resize: none;" required=""></textarea>
			<div class="mt-3 d-flex justify-content-end">
				<div class="col-md-8 col-xs-8 d-flex justify-content-end">
					<span><b>Multiple Files :&nbsp;</b></span>
					<input type="file" name="attachment[]" multiple>
				</div>
				<div class="col-md-4 col-xs-4 d-flex justify-content-end">
					<button class="btn btn-primary" style="width: 100%;">Post</button>
				</div>
			</div>
		</form>
	</div>
</div>

@else 
<div class="alert alert-warning" style="margin-top:5%;">
	<h1 style="text-align: center;">THIS COURSE HAVE BEEN ARCHIEVED</h1>
</div>
@endif

@foreach ($posts as $post)

<div class="card-body">
	<div class="row">
		<div class="media comment-box" style="width: 100% !important;">
			<div class="media-left">
				<a href="#">
					<img class="img-responsive user-photo" src="{{ asset('img/'. $post->dosen->photo) }}" style="border-radius: 50%;">
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading">{{ $post->dosen->name }}
					@if (Auth::User()->role == "dosen" && $diffHours > 0)
					
					<form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;">
						{{ csrf_field() }}

						<input type="hidden" name="_method" value="DELETE">
						<div style="float: right;">

							<a href="#" class="btn btn-info btn-sm" style="display: inline-block;" data-toggle="modal" data-target="#add-attachment{{ $post->id }}">
								<i class="fa fa-paperclip"></i>
							</a>

							<a href="#" class="btn btn-primary btn-sm" style="display: inline-block;" data-toggle="modal" data-target="#edit-post{{ $post->id }}">
								<i class="fa fa-pen"></i>
							</a>

							<button class="btn btn-danger btn-sm" type="submit" style="display: inline-block;">
								<i class="fa fa-times"></i>
							</button>
						</div>
					</form>

				<!-- MODAL ADD ATTACHMENT -->
				<div id="add-attachment{{ $post->id }}" class="modal fade in" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Attachment</h5>

							</div>
							<form action="{{ route('attachment.store') }}" method="POST" enctype="multipart/form-data">
								<div class="modal-body">

									{{ csrf_field() }}

									<input type="hidden" name="post_id" value="{{ $post->id }}">
									<p>Select multiple attachment :</p>
									<input type="file" name="attachment[]" required="" multiple>

								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Upload</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- MODAL ADD ATTACHMENT -->

				<!-- MODAL EDIT COURSES -->
				<div id="edit-post{{ $post->id }}" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">

								<h4 class="modal-title">Edit Post Content</h4>
							</div>
							<form action="{{ route('post.update', $post->id) }}" method="POST">
								{{ csrf_field() }}

								<div class="modal-body">

									<label>Post Content:</label>
									<textarea class="form-control" rows="3" id="post_content" name="post_content" style="resize: none;" required="">{{ $post->post_content }}</textarea>
								</div>

								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- MODAL EDIT COURSES -->

				@endif
			</h4>
			<div class="card">
				<div class="card-body">
					{{ $post->post_content }} <br>

					@foreach ($post->attachments as $attachment)

					<form action="{{ route('file.destroy', $attachment->id) }}" method="POST" style="display: inline;">
						{{ csrf_field() }}

						<a href="{{ asset($attachment->url) }}" download="">
							<i class="fa fa-file"> {{ $attachment->file }}</i>
						</a> 
						@if(Auth::User()->role == "dosen" && $diffHours > 0)
						<input type="hidden" name="post_id" value="{{ $post->id }}">
						<input type="hidden" name="_method" value="DELETE">
						<button class="btn btn-sm" type="submit">
							<i class="fa fa-trash"></i>
						</button>
						@endif <br>
						
					</form>

					@endforeach
				</div>
			</div>


			@for ($i = 0; $i < count($post->comments); $i++)

			<!-- INI BAGIAN ISI KOMENTAR -->
			<div class="media">
				<div class="media-left">
					<a>
						<img class="img-responsive user-photo" src="{{ asset('img/'. $post->comments[$i]->photo) }}" style="border-radius: 50%;">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading">{{ $post->comments[$i]->name}}
						<!-- -->
						@if ($post->comments[$i]->user_id == Auth::User()->id && $diffHours > 0 || Auth::User()->role == "dosen" && $diffHours > 0)

						<form action="{{ route('comment.destroy', $post->comments[$i]->id) }}" method="POST" style="display: inline;">
							{{ csrf_field() }}

							<input type="hidden" name="_method" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit" style="float: right;">
								<i class="fa fa-times"></i>
							</button>
						</form>

						@endif
					</h4>

					<p>{{ $post->comments[$i]->comment_content }}</p>
				</div>
			</div>
			@endfor
			
			@if ($diffHours > 0)
			<form action="{{ route('comment.store') }}" method="POST" class="mt-2">
				{{ csrf_field() }}

				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<textarea class="form-control" rows="2" name="comment_content" id="comment_content" style="resize: none;" required="" placeholder="Write your comment here. . ."></textarea>

				<div class=" mt-2">
					<button class="btn btn-primary" style="float: right;">Comment</button>
				</div>

			</form>
			@endif
		</div>
	</div>
</div>
</div>

@endforeach

@endsection