<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Verificar Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md text-center">
    <h2 class="text-xl font-bold mb-4">Verifique seu e-mail</h2>

    <p class="mb-4 text-gray-600">
        Enviamos um link de verificação para o seu e-mail.
        Clique no link para ativar sua conta.
    </p>

    @if (session('message'))
        <div class="bg-green-100 text-green-600 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Reenviar email
        </button>
    </form>

    <a  href="{{ route('user.login') }}" class="text-red-600 text-sm mt-4">
            Sair
    </a>
</div>

</body>
</html>
