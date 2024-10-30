<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecionamento</title>
    @vite('resources/css/app.css')
    <script>
        window.onload = function() {
            window.location.href = "{{ route('login') }}";
        };
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-center mb-6">Bem-vindo!</h2>
        <p class="text-center text-gray-600 mb-8">Você será redirecionado em breve...</p>
    </div>
</body>
</html>
