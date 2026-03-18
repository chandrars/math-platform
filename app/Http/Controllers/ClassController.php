<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
	public function create()
	{
		return view('classes.create');
	}
	
	public function store(Request $request)
	{
		ClassModel::create([
			'teacher_id' => auth()->id(),
			'title' => $request->title,
			'description' => $request->description,
			'price' => $request->price,
			'schedule' => $request->schedule,
			'max_students' => $request->max_students
		]);

		return redirect('/teacher/dashboard')->with('success', 'Class created!');
	}
}

?>