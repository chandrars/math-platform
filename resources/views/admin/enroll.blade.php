@extends('layouts.admin')

@section('title', 'Enroll Student')

@section('content')

<h2 class="text-xl font-bold mb-4">Enroll Student</h2>

<form method="POST" action="{{ route('admin.enroll.store', $class->id) }}">
    @csrf

    <select name="user_id" class="border p-2">
        @foreach($students as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
        @endforeach
    </select>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Enroll
    </button>

</form>

@endsection