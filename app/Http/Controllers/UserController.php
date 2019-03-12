<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        $courses = Course::with('dosen')->orderBy('courses.created_at', 'desc')->get();
 
        return view('index', ['courses' => $courses]);
        // return response()->json(['courses' => $courses]);
    }
}
