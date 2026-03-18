@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto mt-6">

    <h2 class="text-2xl font-bold mb-6">My Classes</h2>

    @foreach($classes as $class)
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">

            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ $class->title }}
            </h3>

            <p class="text-gray-600 dark:text-gray-300 mt-2">
                {{ $class->description }}
            </p>

            <div class="mt-4 text-sm text-gray-500">
                <span class="font-medium">Schedule:</span> {{ $class->schedule }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                <span class="font-medium">Price:</span> ₹{{ $class->price }}
            </div>

            <div class="mt-4">
                <span class="font-semibold text-gray-700 dark:text-gray-200">
                    Students Enrolled ({{ $class->enrollments->count() }}):
                </span>

                <ul class="mt-2 space-y-1">
                    @foreach($class->enrollments as $enroll)
                        <li class="text-gray-600 dark:text-gray-300">
                            {{ $enroll->student->name }} 
                            <span class="text-xs text-gray-400">({{ $enroll->student->email }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    @endforeach
	
	@if($classes->isEmpty())
    <p class="text-gray-500">No classes created yet.</p>
	@endif

</div>

@endsection