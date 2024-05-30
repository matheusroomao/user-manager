<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('toastr_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    
</head>

<body>
    <main class="d-flex flex-nowrap" style="height: 100vh;">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-primary" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="bi-people-fill fs-1 me-4"></i>
                <span class="fs-5">Gerenciamento Usuário</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="{{ route('user.index') }}" class="nav-link text-white">
                        <i class="bi-person-lines-fill me-2"></i>
                        Listagem de Usuários
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('user.create') }}" class="nav-link text-white" >
                        <i class="bi-plus-circle-fill me-2"></i>
                        Criar Usuário
                    </a>
                </li>
            </ul>
        </div>
        <div class="b-example-divider b-example-vr"></div>

        <div class="d-flex flex-column flex-grow-1">
            @yield('content')
        </div>
    </main>
</body>

</html>