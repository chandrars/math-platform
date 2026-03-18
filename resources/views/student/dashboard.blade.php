@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">My Classes</h2>
	
	

    @if($classes->isEmpty())

        <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
            You are not enrolled in any classes yet.
        </div>

    @else

        <div class="grid grid-cols-3 gap-4">

            @foreach($classes as $class)
                <div class="bg-white p-4 rounded shadow">

                    <h3 class="font-bold text-lg">
                        {{ $class->title }}
                    </h3>

                    <p class="text-sm text-gray-600 mt-1">
                        Teacher: {{ $class->teacher->name ?? 'Not Assigned' }}
                    </p>

                    <p class="text-sm mt-2">
                        {{ $class->description ?? 'No description available' }}
                    </p>

                    <p class="text-sm mt-2 text-gray-500">
                        Capacity: {{ $class->students->count() }} / {{ $class->max_students }}
                    </p>

                </div>
            @endforeach

        </div>

    @endif

</div>

@endsection