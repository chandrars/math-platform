@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
        Teacher Dashboard
    </h2>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <p class="text-gray-500 dark:text-gray-400">Total Classes</p>
			<h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalClasses }}</h3><
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <p class="text-gray-500 dark:text-gray-400">Total Students</p>
			<h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalStudents }}</h3>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <a href="/teacher/classes/create"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Create New Class
        </a>
    </div>

    <!-- Recent Classes -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
		<h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">
			Your Classes
		</h3>

        @foreach($classes as $class)
            <div class="border-b py-3">
                <p class="font-medium text-gray-900 dark:text-white">
					{{ $class->title }}
				</p>

				<p class="text-sm text-gray-500 dark:text-gray-400">
					{{ $class->schedule }}
				</p>
            </div>
        @endforeach

    </div>

</div>

@endsection