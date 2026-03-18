<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">

        <div class="p-4 text-lg font-bold border-b border-gray-700">
            Admin Panel
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="/admin/dashboard" class="block px-3 py-2 rounded hover:bg-gray-700">
                Dashboard
            </a>

            <a href="/admin/users" class="block px-3 py-2 rounded hover:bg-gray-700">
                Users
            </a>

            <a href="{{ route('admin.classes') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
				Classes
			</a>

        </nav>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 bg-red-500 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between">
            <h1 class="text-lg font-semibold">@yield('title')</h1>

            <div>
                {{ auth()->user()->name }}
            </div>
        </header>

        <!-- Content -->
        <main class="p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>