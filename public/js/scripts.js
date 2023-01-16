const modal = document.querySelector('.modal-container');
var numConfirm = 0;
let active = false;

const { forEach } = require("lodash");
    
function openModalProjects(id){
    const formDel = document.querySelector('#del-aviso'); 
    if(numConfirm == 0){
        formDel.setAttribute('action', `https://pietronunes.com.br/direct_tasks/public/projects/${id}`);
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
        formDel.setAttribute('action', `https://pietronunes.com.br/direct_tasks/public/versions/${id}`);
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
        formDel.setAttribute('action', `https://pietronunes.com.br/direct_tasks/public/users/${id}`);
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
        formDel.setAttribute('action', `https://pietronunes.com.br/direct_tasks/public/tasks/${id}`);
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

function openCloseOptions(){
    let formNav = document.querySelector('.nav-left');
    if(active == true){
        formNav.classList.remove('active');
        return active = false;
    }else{
        formNav.classList.add('active');
        return active = true;
    }
}