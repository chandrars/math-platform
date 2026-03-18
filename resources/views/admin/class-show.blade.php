@extends('layouts.admin')

@section('title', 'Class Details')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-4">{{ $class->title }}</h2>

    <p class="mb-2">
        <strong>Teacher:</strong> 
        {{ $class->teacher->name ?? 'Not Assigned' }}
    </p>

    <p class="mb-2">
        <strong>Description:</strong> 
        {{ $class->description ?? 'No description provided' }}
    </p>

    <p class="mb-2">
        <strong>Max Students:</strong> 
        {{ $class->max_students }}
    </p>

    <p class="mb-4">
        <strong>Enrolled:</strong> 
        {{ $class->students->count() }}
    </p>
	
	<p class="mb-4">
	<strong>Seats left:</strong> {{ $class->max_students - $currentCount }}
	</p>
</div>

<!-- Enroll Student -->
<div class="bg-white p-6 rounded shadow mt-6">

    <h3 class="text-xl font-bold mb-3">Enroll Student</h3>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($students->isEmpty())
		
        <p class="text-gray-500">All students are already enrolled.</p>
	
    @elseif($currentCount >= $class->max_students)

    <div class="bg-red-100 text-red-700 p-3 rounded">
        Class is full ({{ $class->max_students }} students). No more enrollments allowed.
    </div>

	@else

    <!-- Existing Enroll Form -->
        <form method="POST" action="{{ route('admin.enroll.store', $class->id) }}">
            @csrf

            <div class="flex gap-2">
                <select name="user_id" class="border p-2 rounded w-full">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->name }} ({{ $student->email }})
                        </option>
                    @endforeach
                </select>

                <button class="bg-green-500 text-white px-4 rounded">
                    Enroll
                </button>
            </div>
        </form>
    @endif

</div>

<!-- Students List -->
<div class="mt-6 bg-white p-6 rounded shadow">

    <h3 class="text-xl font-bold mb-3">Enrolled Students</h3>

    @if($class->students->isEmpty())
        <p class="text-gray-500">No students enrolled yet.</p>
    @else
        <ul class="space-y-2">
			@foreach($class->students as $student)
				<li class="border p-3 rounded flex justify-between items-center">

					<div>
						{{ $student->name }} ({{ $student->email }})
					</div>

					<!-- Remove Button -->
					<form method="POST" 
						  action="{{ route('admin.remove.student', [$class->id, $student->id]) }}"
						  onsubmit="return confirm('Remove {{ addslashes($student->name) }} from this class?')">
						@csrf
						@method('DELETE')

						<button class="bg-red-500 text-white px-3 py-1 rounded text-xs">
							Remove
						</button>
					</form>

				</li>
			@endforeach
		</ul>
    @endif

</div>

@endsection