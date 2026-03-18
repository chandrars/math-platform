@extends('layouts.admin')

@section('title', 'Classes')

@section('content')

<a href="{{ route('admin.classes.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
    + Create Class
</a>

<h2 class="text-xl font-bold mb-4">Classes</h2>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <td class="p-3">ID</td>
                <td class="p-3">Title</td>
                <td class="p-3">Price</td>
				<td class="p-3">Max_Students</td>
				<td class="p-3">Class Schedule</td>
            </tr>
        </thead>

        <tbody>
            @foreach($classes as $class)
            <tr class="border-t">
                <td class="p-3">{{ $class->id }}</td>
                <td class="p-3"><a href="{{ route('admin.classes.show', $class->id) }}" 
   class="text-blue-600 hover:underline">
    {{ $class->title ?? 'N/A' }}
</a></td>
                <td class="p-3">{{ $class->price }}</td>
				<td class="p-3">{{ $class->max_students }}</td>
				<td class="p-3 space-x-2">{{ $class->schedule }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

<!-- 
					<a href="{{ route('admin.classes.create') }}"
					   class="bg-blue-500 text-white px-2 py-1 rounded text-xs">
						Assign Teacher
					</a>

					
					<a href="{{ route('admin.enroll.form', $class->id) }}"
					   class="bg-green-500 text-white px-2 py-1 rounded text-xs">
						Enroll Students
					</a>
-->