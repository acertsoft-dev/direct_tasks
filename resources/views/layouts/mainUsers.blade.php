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
            <img src="/direct_tasks/public/imgs/generic.png" alt="Foto do usuário">
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

    <script src="/direct_tasks/public/js/scripts.js"></script>
    
    <script>
        const { forEach } = require("lodash");

const modal = document.querySelector('.modal-container');
let numConfirm = 0;

function openModalProjects(id){
    const formDel = document.querySelector('#del-aviso'); 
    if(numConfirm == 0){
        formDel.setAttribute('action', `/projects/${id}`);
        numConfirm = 1;
        return modal.classList.add('active');
    }
    return modal.classList.add('active');
}
function closeModalProjects(){
    return modal.classList.remove('active');
}

function openModalVersions(id){
    const formDel = document.querySelector('#del-aviso'); 
    if(numConfirm == 0){
        formDel.setAttribute('action', `/versions/${id}`);
        numConfirm = 1;
        return modal.classList.add('active');
    }
    return modal.classList.add('active');
}
function closeModalVersions(){
    return modal.classList.remove('active');
}

function openModalUsers(id){
    const formDel = document.querySelector('#del-aviso'); 
    if(numConfirm == 0){
        formDel.setAttribute('action', `/users/${id}`);
        numConfirm = 1;
        return modal.classList.add('active');
    }
    return modal.classList.add('active');
}
function closeModalUsers(){
    return modal.classList.remove('active');
}

function openModalTasks(id){
    const formDel = document.querySelector('#del-aviso'); 
    if(numConfirm == 0){
        formDel.setAttribute('action', `/tasks/${id}`);
        numConfirm = 1;
        return modal.classList.add('active');
    }
    return modal.classList.add('active');
}
function closeModalTasks(){
    return modal.classList.remove('active');
}

function openVersion(idProject, versionsProjects){
    console.log(idProject, versionsProjects);
    
    const version = document.getElementById('id_version')
    version.disabled = false;
    
    versionsProjects.forEach(element => {
        version.remove(element);
    });

    versionsProjects.forEach(element => {
        if(element.project_id == idProject){
            let opt = document.createElement('option');
            opt.value = element.id;
            opt.text = element.name;
            version.add(opt, version.option);
        }
    });
}

function openSolution(status){
    const solution = document.getElementById('solution');
    
    if(status == 'Concluida'){
        solution.required = true;
        return solution.disabled = false;
    }
    if(status == 'Em andamento'){
        solution.disabled = true;
        solution.value = null
        return solution.this.value = null;
    }
    solution.disabled = true;
    solution.value = null
    solution.this.value = null;
}

function loadFiles(input){
    console.log(input);
    if (input.files && input.files[0]) { //verifica se o arquivo não está nulo
        console.log(input.files.length);
        for(let i = 0; i <= input.files.length; i++){
            var reader = new FileReader(); //instancia um objeto FileReader que permite aplicações web ler o conteúdo dos arquivos (ou buffers de dados puros)
            reader.onload = function (e) { //Este evento é chamado cada vez que a operação de leitura é completada com sucesso.
                $('#imgFiles').attr('src', e.target.result); //aqui seto a imagem no src da div a cima
            }
            reader.readAsDataURL(input.files[i]); //Inicia a leitura do conteúdo que caira após o peração completar na função a cima
            console.log(input.files[i]);
        }
    }   
}
function previewFiles() {

    var tableUp = document.querySelector('#preview');
    var files   = document.querySelector('input[type=file]').files;
    var screen = document.getElementById('invisible');
    var removeView = document.querySelector('#tableUp');
    var removeFile = removeView ? removeView.parentNode : null;
    if(removeFile){
        removeFile.removeChild(removeView);
    }
    var table = document.createElement('table');
    table.id = 'tableUp';

    function readAndPreview(file) {
        
        var reader = new FileReader();
        reader.addEventListener("load", function () {
            var tr = document.createElement('tr');
            var td = document.createElement('td'); 
            var a = document.createElement('a');
            tr.className = 'removeFileView';
            a.textContent = file.name;
            tableUp.appendChild(table);
            table.appendChild(tr);
            tr.appendChild(td);
            td.appendChild(a);
        }, false);
        reader.readAsDataURL(file);
    }
    
    if (files) {
        [].forEach.call(files, readAndPreview);
    }
    
    screen.style.display = 'flex';
}
    </script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
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
