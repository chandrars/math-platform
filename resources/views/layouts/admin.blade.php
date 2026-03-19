<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
	<script>
		tailwind.config = {
			darkMode: 'class'
		}
	</script>
	<script src="https://cdn.tailwindcss.com"></script> 
</head>

<body class="bg-gray-100">

<!-- 🔵 TOP NAVBAR -->
<nav class="bg-gray-900 text-white px-6 py-3 flex justify-between items-center">

    <!-- Left -->
    <div class="text-lg font-semibold">
        Admin Panel
    </div>

    <!-- Center -->
    <div class="hidden md:flex space-x-6">
        <a href="/admin/dashboard" class="hover:text-gray-300">Dashboard</a>
        <a href="{{ route('admin.users') }}" class="hover:text-gray-300">Users</a>
        <a href="{{ route('admin.classes') }}" class="hover:text-gray-300">Classes</a>
    </div>

    <!-- Right -->
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>

</nav>

<!-- 🔷 MOBILE MENU -->
<div class="md:hidden bg-gray-800 text-white px-6 py-3 space-y-2">
    <a href="/admin/dashboard" class="block">Dashboard</a>
    <a href="/admin/users" class="block">Users</a>
    <a href="{{ route('admin.classes') }}" class="block">Classes</a>
</div>

<!-- 🟢 MAIN CONTENT -->
<main class="p-6">
    @yield('content')
</main>

</body>
</html>