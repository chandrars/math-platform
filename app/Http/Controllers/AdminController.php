<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassModel;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	
	public function index()
	{
		return view('admin.dashboard');
	}

	public function users()
	{
		$users = User::latest()->get();
		return view('admin.users', compact('users'));
	}

	public function makeTeacher($id)
	{
		$user = User::findOrFail($id);
		$user->role = 'teacher';
		
		//if ($user->id !== auth()->id() && $user->role !== 'admin')
		if ($user->id === auth()->id()) {
			return back()->with('error', 'You cannot modify yourself');
		}
		
		$user->save();

		return back()->with('success', 'User promoted to teacher');
	}
	
	public function classes()
	{
		return view('admin.classes', [
			'classes' => ClassModel::latest()->get()
		]);
	}
	
	public function createClass()
	{
		$teachers = User::where('role', 'teacher')->get();

		return view('admin.create-class', compact('teachers'));
	}
	
	public function storeClass(Request $request)
	{
		$request->validate([
			'title' => 'required|string|max:255',
			'teacher_id' => 'nullable|exists:users,id',
			'max_students' => 'required|integer|min:1',
			'price' => 'required|integer|min:0',
			'description' => 'nullable|string',
			'schedule' => 'nullable|string',
		]);

		ClassModel::create([
			'title' => $request->title,
			'teacher_id' => $request->teacher_id,
			'max_students' => $request->max_students,
			'price' => $request->price,
			'description' => $request->description,
			'schedule' => $request->schedule,
		]);

		return redirect()->route('admin.classes')->with('success', 'Class created');
	}
	
	public function enrollForm($id)
	{
		$class = ClassModel::findOrFail($id);
		$students = User::where('role', 'student')->get();

		return view('admin.enroll', compact('class', 'students'));
	}

	public function enrollStudent(Request $request, $id)
	{
		$class = ClassModel::findOrFail($id);

		$request->validate([
			'user_id' => 'required|exists:users,id',
		]);

		// 🔥 Already enrolled check
		$alreadyEnrolled = Enrollment::where('class_model_id', $id)
			->where('user_id', $request->user_id)
			->exists();

		if ($alreadyEnrolled) {
			return back()->with('error', 'Student already enrolled');
		}

		// 🔥 Max students check
		$currentCount = Enrollment::where('class_model_id', $id)->count();

		if ($currentCount >= $class->max_students) {
			return back()->with('error', 'Class is full. Cannot enroll more students.');
		}

		// ✅ Enroll
		Enrollment::create([
			'class_model_id' => $id,
			'user_id' => $request->user_id,
		]);

		return back()->with('success', 'Student enrolled successfully');
	}
	
	public function editTeacher($id)
	{
		$class = ClassModel::findOrFail($id);
		$teachers = User::where('role', 'teacher')->get();

		return view('admin.assign-teacher', compact('class', 'teachers'));
	}

	public function updateTeacher(Request $request, $id)
	{
		$class = ClassModel::findOrFail($id);

		$class->teacher_id = $request->teacher_id;
		$class->save();

		return redirect()->route('admin.classes')->with('success', 'Teacher assigned');
	}

	public function showClass($id)
	{
		$class = ClassModel::with(['teacher', 'students'])->findOrFail($id);

		$enrolledIds = $class->students->pluck('id');

		$students = User::where('role', 'student')
			->whereNotIn('id', $enrolledIds)
			->get();

		$currentCount = $class->students->count();

		return view('admin.class-show', compact('class', 'students', 'currentCount'));
	}
	
	public function removeStudent($classId, $userId)
	{
		$enrollment = Enrollment::where('class_model_id', $classId)
			->where('user_id', $userId)
			->first();

		if (!$enrollment) {
			return back()->with('error', 'Student not found in this class');
		}

		$enrollment->delete();

		return back()->with('success', 'Student removed successfully');
	}
	
	public function createUser()
	{
		return view('admin.create-user');
	}

	public function storeUser(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:8',
		]);

		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		return redirect()->route('admin.users')->with('success', 'User created successfully');
	}
}
