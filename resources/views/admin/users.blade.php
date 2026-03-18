@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="border-t">
                    <td class="p-3">{{ $user->id }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>

                    <td class="p-3">
                        <span class="
                            px-2 py-1 rounded text-xs font-semibold
                            @if($user->role == 'admin') bg-red-100 text-red-600
                            @elseif($user->role == 'teacher') bg-blue-100 text-blue-600
                            @else bg-gray-100 text-gray-600
                            @endif
                        ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td class="p-3 text-center">
                        @if($user->role === 'student')
                            <form method="POST" action="{{ route('admin.makeTeacher', $user->id) }}">
                                @csrf
                                <button 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                    Make Teacher
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs">No Action</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection