@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-3 gap-4">

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-sm text-gray-500">Total Users</h2>
        <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-sm text-gray-500">Teachers</h2>
        <p class="text-2xl font-bold">{{ \App\Models\User::where('role', 'teacher')->count() }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-sm text-gray-500">Students</h2>
        <p class="text-2xl font-bold">{{ \App\Models\User::where('role', 'student')->count() }}</p>
    </div>

</div>

@endsection