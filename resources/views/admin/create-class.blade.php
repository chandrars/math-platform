@extends('layouts.admin')

@section('title', 'Create Class')

@section('content')

<h2 class="text-xl font-bold mb-4">Create Class</h2>

<form method="POST" action="{{ route('admin.classes.store') }}" class="bg-white p-6 rounded shadow">
    @csrf

    <!-- Class Title -->
    <div class="mb-4">
        <label class="block mb-1">Class Title</label>
        <input type="text" name="title" class="w-full border p-2 rounded" required>
    </div>
	
	<div class="mb-4">
    <label class="block mb-1">Description</label>
    <textarea name="description" 
              class="w-full border p-2 rounded"></textarea>
	</div>
	
	<div class="mb-4">
    <label class="block mb-1">Max Students</label>
    <input type="number" name="max_students" 
           class="w-full border p-2 rounded" 
           min="1" required>
	</div>
	
	<div class="mb-4">
    <label class="block mb-1">Price</label>
    <input type="number" name="price" 
           class="w-full border p-2 rounded" 
           min="0" required>
	</div>	
	
    <div class="mb-4">
        <label class="block mb-1">Class Schedule</label>
        <input type="text" name="schedule" class="w-full border p-2 rounded" required>
    </div>	

    <!-- Assign Teacher -->
    <div class="mb-4">
        <label class="block mb-1">Assign Teacher</label>
        <select name="teacher_id" class="w-full border p-2 rounded">
            <option value="">-- Select Teacher --</option>

            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">
                    {{ $teacher->name }}
                </option>
            @endforeach

        </select>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Create Class
    </button>

</form>

@endsection