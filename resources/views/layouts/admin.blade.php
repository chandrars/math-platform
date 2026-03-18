<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col p-4">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

        <a href="/admin/dashboard" class="block px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>
        <a href="/admin/users" class="block px-3 py-2 rounded hover:bg-gray-700">Users</a>
        <a href="{{ route('admin.classes') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Classes</a>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button class="w-full text-left px-3 py-2 bg-red-500 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">

        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between">
            <h1 class="font-bold">{{ auth()->user()->name }}</h1>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>