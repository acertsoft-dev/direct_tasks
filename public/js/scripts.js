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
    if (input.files && input.files[0]) { //verifica se o arquivo n??o est?? nulo
        console.log(input.files.length);
        for(let i = 0; i <= input.files.length; i++){
            var reader = new FileReader(); //instancia um objeto FileReader que permite aplica????es web ler o conte??do dos arquivos (ou buffers de dados puros)
            reader.onload = function (e) { //Este evento ?? chamado cada vez que a opera????o de leitura ?? completada com sucesso.
                $('#imgFiles').attr('src', e.target.result); //aqui seto a imagem no src da div a cima
            }
            reader.readAsDataURL(input.files[i]); //Inicia a leitura do conte??do que caira ap??s o pera????o completar na fun????o a cima
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

/* Preview de imagens*/
// function backImages(files){
//     var tableUp = document.querySelector('#tableUp');
//     var click = document.getElementById('click');
//     const arrayImgs = files.split(';');

//     arrayImgs.forEach(file => {
//         var tr = document.createElement('tr');
//         var td = document.createElement('td'); 
//         var a = document.createElement('a');

//         click.style.display = 'none';
//         a.innerText = file;
//         a.href = `{{ url("/tasks/6/edit/download/${file}") }}`;

//         tableUp.appendChild(tr);
//         tr.appendChild(td);
//         td.appendChild(a);
//     });
//     console.log(arrayImgs);
// }