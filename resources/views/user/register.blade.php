<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Criar Conta</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.register') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Nome</label>
            <input type="text" name="name" required
                class="w-full border px-3 py-2 rounded">
        </div>

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

        <div class="mb-4">
            <label class="block mb-1">Confirmar Senha</label>
            <input type="password" name="password_confirmation" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Registrar
        </button>
    </form>
</div>

</body>
</html>
