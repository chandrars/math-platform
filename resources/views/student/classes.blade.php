@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
        Available Classes
    </h2>

@if($classes->isEmpty())

    <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
        No classes available yet. Please check back later.
    </div>

@else

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @foreach($classes as $class)
		
@php
    $seatsLeft = $class->max_students - $class->enrollments->count();
@endphp		

            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">

                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $class->title }}
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    {{ $class->description }}
                </p>

                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    Price: ₹{{ $class->price }}
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Schedule: {{ $class->schedule }}
                </div>

				<div class="text-sm text-gray-500 dark:text-gray-400">
					Seats Left: {{ $seatsLeft }}
				</div>

                <!-- Action -->
                <div class="mt-4">

                    @if($class->is_enrolled)
                        <span class="text-green-600 font-medium">
                            Already Enrolled
                        </span>
						
					@elseif($seatsLeft <= 0)
						<span class="text-red-500 font-medium">
							Class Full
						</span>
						
                    @else
                        <form method="POST" action="/enroll/{{ $class->id }}">
                            @csrf
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                Enroll
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        @endforeach

    </div>
@endif

</div>

@endsection
