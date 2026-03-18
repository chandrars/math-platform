@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
        Student Dashboard
    </h2>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-500 dark:text-gray-400">Enrolled Classes</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $totalEnrollments }}
            </h3>
        </div>

    </div>

    <!-- Browse Classes Button -->
    <div class="mb-8">
        <a href="/classes"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            Browse Classes
        </a>
    </div>

    <!-- Enrolled Classes -->
    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">

        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">
            Your Classes
        </h3>

        @forelse($enrollments as $enroll)
            <div class="border-b py-3">

                <p class="font-medium text-gray-900 dark:text-white">
                    {{ $enroll->class->title }}
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $enroll->class->schedule }}
                </p>

            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">
                You have not enrolled in any classes yet.
            </p>
        @endforelse

    </div>

</div>

@endsection