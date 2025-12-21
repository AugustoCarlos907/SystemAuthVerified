<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<nav class="bg-white shadow px-6 py-4 flex justify-between">
    <span class="font-bold">Dashboard</span>

    <form method="POST" action="{{ route('user.logout') }}">
        @csrf
        <button class="text-red-600">Logout</button>
    </form>
</nav>

<main class="p-6">
    <h1 class="text-2xl font-bold mb-4">
        Bem-vindo, {{ auth()->guard('user')->user()->name }}
    </h1>

    <p class="text-gray-600">
        Seu email está verificado ✅
    </p>
</main>

</body>
</html>
