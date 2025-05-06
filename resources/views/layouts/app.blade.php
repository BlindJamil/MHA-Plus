<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MHA Plus')</title>
    
    <!-- Vite CSS -->
    @vite('resources/css/app.css')
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .btn-gradient {
            background: linear-gradient(90deg, #2b8a98, #0f5e8d);
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen">
    <main>
        @yield('content')
    </main>
    
    <!-- Vite JS -->
    @vite('resources/js/app.js')
</body>
</html>