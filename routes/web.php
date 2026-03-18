<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Models\Enrollment;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

	Route::get('/student/dashboard', function () {
		return view('student.dashboard');
    });

    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    });

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
	
	Route::get('/classes', function () {
		//$classes = ClassModel::all();
		$classes = ClassModel::with('enrollments')->get();

			foreach ($classes as $class) {
				$class->is_enrolled = $class->enrollments
					->where('user_id', auth()->id())
					->count() > 0;
			}
		return view('student.classes', compact('classes'));
	});
	
	Route::post('/enroll/{class}', function ($classId) {
		
		$class = ClassModel::with('enrollments')->findOrFail($classId);
		
		$alreadyEnrolled = Enrollment::where('user_id', auth()->id())
        ->where('class_model_id', $classId)
        ->exists();

		if ($alreadyEnrolled) {
			return back()->with('error', 'You are already enrolled!');
		}
		
		// Seat limit check
		if ($class->enrollments->count() >= $class->max_students) {
			return back()->with('error', 'Class is full.');
		}

		Enrollment::create([
			'user_id' => auth()->id(),
			'class_model_id' => $classId
		]);

		return back()->with('success', 'Enrolled successfully!');
	});
	

	
Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/teacher/classes', function () {
        $classes = ClassModel::with('enrollments.student')
            ->where('teacher_id', auth()->id())
            ->get();

        return view('teacher.classes', compact('classes'));
    });
	
	Route::get('/teacher/dashboard', function () {

        $classes = ClassModel::where('teacher_id', auth()->id())->get();

        $totalClasses = $classes->count();

        $totalStudents = Enrollment::whereIn('class_model_id', $classes->pluck('id'))->count();

        return view('teacher.dashboard', compact('totalClasses', 'totalStudents', 'classes'));
    });

    Route::get('/teacher/classes/create', [ClassController::class, 'create']);
    Route::post('/teacher/classes/store', [ClassController::class, 'store']);

});

	

Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', function () {

        $enrollments = Enrollment::with('class')
            ->where('user_id', auth()->id())
            ->get();

        $totalEnrollments = $enrollments->count();

        return view('student.dashboard', compact('enrollments', 'totalEnrollments'));
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index']);

    Route::get('/admin/users', [AdminController::class, 'users']);

    //Route::post('/admin/make-teacher/{id}', [AdminController::class, 'makeTeacher']);
	
	Route::post('/admin/make-teacher/{id}', [AdminController::class, 'makeTeacher'])
    ->name('admin.makeTeacher');
	
	Route::get('/admin/classes', [AdminController::class, 'classes'])
        ->name('admin.classes');
		
	Route::get('/admin/classes/create', [AdminController::class, 'createClass'])->name('admin.classes.create');

	Route::post('/admin/classes', [AdminController::class, 'storeClass'])->name('admin.classes.store');
	
	Route::get('/admin/classes/{id}/enroll', [AdminController::class, 'enrollForm'])->name('admin.enroll.form');
	
	Route::post('/admin/classes/{id}/enroll', [AdminController::class, 'enrollStudent'])->name('admin.enroll.store');
	
	Route::get('/admin/classes/{id}/assign-teacher', [AdminController::class, 'editTeacher'])
    ->name('admin.assign.teacher');

	Route::post('/admin/classes/{id}/assign-teacher', [AdminController::class, 'updateTeacher'])
    ->name('admin.assign.teacher.update');
	
	Route::get('/admin/classes/{id}', [AdminController::class, 'showClass'])
    ->name('admin.classes.show');
	
	Route::post('/admin/classes/{id}/enroll', [AdminController::class, 'enrollStudent'])
    ->name('admin.enroll.store');
	
	Route::delete('/admin/classes/{classId}/remove-student/{userId}', 
    [AdminController::class, 'removeStudent'])->name('admin.remove.student');
});

Route::get('/dashboard', function () {

    if (auth()->user()->role == 'teacher') {
        return redirect('/teacher/classes');
    } else if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/classes');

})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
