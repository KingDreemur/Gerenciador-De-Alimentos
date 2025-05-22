<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('titulo')"Minha Aplicação"</title>
    <link rel="stylesheet" href="{{ asset('css/alimentos.css') }}">

</head>
<body>
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>