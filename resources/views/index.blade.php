@extends('template.master')

@section('content')

<div class="mt-5 mb-5">
	@if (Auth::User()->role == 'dosen')
	<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_course">Add New Courses</button>
	@endif
	
	<div class="card">
		<div class="card-body alert-primary">
			<h4>Welcome, {{ Auth::User()->name }}. This is your courses.</h4>
		</div>
	</div>
</div>

@if(session()->has('success'))
<div class="alert alert-success">
	{{ session()->get('success') }}
</div>
@endif

@if ($courses->isEmpty())
<div class="card">
	<div class="card-body alert-warning">
		<h4>No course available</h4>
	</div>
</div>
@endif

@foreach ($courses as $course)

<div class="card mt-5">
	<div class="card-header">
		<h2>{{ $course->course_name }}</h2>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<img src="{{ asset('img/'.$course->dosen->photo) }}" alt="" width="200px">
			</div>
			<div class="col-9">
				<p>{{ $course->description }}</p>
				<h4>By : {{ $course->dosen->name }}</h4>
				<h5>Started : {{ $course->start_date }}</h5>

				<?php
				$day1 = date('Y-m-d H:i:s');
				$day1 = strtotime($day1);
				$day2 = $course->end_date;
				$day2 = strtotime($day2);
				$diffHours = round(($day2 - $day1) / 3600);
				?>
				
				@if ($diffHours < 0)
				<h5>Ended in : Already over</h5>
				
				@elseif ($diffHours < 1)
				<h5>Ended in : Less than 1 hours</h5>

				@else
				<h5>Ended in : {{ $diffHours }} hours</h5>
				@endif
				
				<div>
					<a href="{{ route('course_detail', $course->id) }}" class="btn btn-primary">View Course</a>

					@if (Auth::User()->role == 'dosen')
					<button class="btn btn-info" data-toggle="modal" data-target="#edit_course{{ $course->id }}">Edit</button>

					<form style="display: inline-block;" action="{{ route('course.destroy', $course->id) }}" method="POST"> 
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE">
						<button type="submit" class="btn btn-danger"> 
							Delete
						</button>
					</form>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODAL EDIT COURSES -->
<div id="edit_course{{ $course->id }}" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title">Edit Course</h4>
			</div>
			<form action="{{ route('course.update', $course->id) }}" method="POST">
				{{ csrf_field() }}

				<div class="modal-body">

					<div class="form-group">
						<label for="usr">Course Name:</label>
						<input type="text" class="form-control" id="course_name" name="course_name" required="" value="{{ $course->course_name }}">
					</div>
					<div class="form-group">
						<label for="comment">Description:</label>
						<textarea class="form-control" rows="3" id="description" name="description" style="resize: none;" required="">{{ $course->description }}</textarea>
					</div>

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

@endforeach

<!-- MODAL ADD COURSES -->
<div id="add_course" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title">New Course</h4>
			</div>
			<form action="{{ route('course.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="modal-body">

					<div class="form-group">
						<label for="usr">Course Name:</label>
						<input type="text" class="form-control" id="course_name" name="course_name" required="">
					</div>
					<div class="form-group">
						<label for="comment">Description:</label>
						<textarea class="form-control" rows="3" id="description" name="description" style="resize: none;" required=""></textarea>
					</div>
					<div class="form-group">
						<label for="usr">Time Limit (in minute):</label>
						<input type="number" class="form-control" id="time_limit" name="time_limit" required="">
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- MODAL ADD COURSES -->

@endsection