@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Add User</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <div class="mb-4">
        <label class="block mb-1">Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded" required>
    </div>

    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        Save User
    </button>

</form>

@endsection