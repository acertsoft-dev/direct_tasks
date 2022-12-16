<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/direct_tasks/public/css/mainUsersStyle.css">
    <link rel="shortcut icon" href="/direct_tasks/public/imgs/acertsoft.png" type="image/png">
    <link rel="stylesheet" href="/dist/ui/trumbowyg.min.css">
    <title>@yield('Title')</title>
</head>
<body style="height: 100vh">
    <nav class="nav-left">
        <div class="nav-logo">
            <img src="/direct_tasks/public/imgs/acertsoft_logo.png" alt="logo acertsoft">
        </div>
        <div class="nav-menu">
            <ul>
                <li id="home"><a href="{{ url('/homeUser') }}"><ion-icon name="home-outline"></ion-icon>Início</a></li>
                <li id="tarefas"><a href="{{ url('/tasks') }}"><ion-icon name="easel-outline"></ion-icon>Tarefas</a></li>
                <li id="projetos"><a href="{{ url('/projects') }}"><ion-icon name="folder-outline"></ion-icon>Projetos</a></li>
                <li id="versoes"><a href="{{ url('/versions') }}"><ion-icon name="reader-outline"></ion-icon>Versões</a></li>
                <li id="usuarios"><a href="{{ url('/users') }}"><ion-icon name="person-add-outline"></ion-icon>Usuários</a></li>
            </ul>
        </div>
        <div class="card-user">
            <img src="/imgs/generic.png" alt="Foto do usuário">
            <div class="cargo">
                <h2 class="cursor-default">{{ Auth::user()->name }}</h2>
                <p class="cursor-default">Cargo</p>
            </div>
        <a href="{{ route('logout') }}"><button class="btns-exit drop-shadow-lg">Sair</button></a>
        </div>
    </nav>
    <section class="sect-right">
        @section('mainUsers')
        
        @show
    </section>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="/js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="/dist/langs/fr.min.js"></script>
    <script>
        $('#description').trumbowyg({
            btns: 
                [['viewHTML'],
                ['undo', 'redo'],
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']],
            autogrow: true,
            lang: 'Pt-br',
        });
    </script>
</body>
</html>
