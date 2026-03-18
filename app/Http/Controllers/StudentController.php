<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Enrollment;

use Illuminate\Http\Request;

class StudentController extends Controller
{
	public function dashboard()
	{
		$student = auth()->user();

		// 🔥 Get only enrolled classes
		$classes = $student->enrolledClasses()->with('teacher')->get();

		return view('student.dashboard', compact('classes'));
	}
}
