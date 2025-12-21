<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.login.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Senha</label>
            <input type="password" name="password" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Entrar
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="#" class="text-blue-600 text-sm">
            Esqueceu a senha?
        </a><br>
        <a href="{{ route('user.register') }}" class="text-blue-600 text-sm">
            Criar conta
        </a>
    </div>
</div>

</body>
</html>
