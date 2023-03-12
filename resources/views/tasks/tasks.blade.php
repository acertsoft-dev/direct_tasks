@extends('layouts.mainUsers')
<link rel="stylesheet" href="/direct_tasks/public/css/tasksStyle.css">
<link rel="shortcut icon" href="/direct_tasks/public/imgs/acertsoft.png" type="image/png">
@section('Title', 'DirectTarefas - Tarefas')

@section('mainUsers')
    <section class="body-projects">
        <div class="title-project">
            <h1>DirectTarefas - Tarefas</h1>
        </div>
        <div class="btns-projects">
            <div class="buttons-top">
                <button class="btn rounded shadow-md bg-cyan-900 active:shadow-inner active:bg-cyan-600 hover:bg-sky-600"><a href="{{ route('createTasks') }}" method="GET">Novo</a></button>
            </div>
            <div class="search-body">
                <form action="{{ url('/tasks') }}" method="get" class="search-projects">
                    <ion-icon style="--ionicon-stroke-width: 45px; padding: 8px; font-size: 16px; border: solid 1px rgb(180, 180, 180);" class="shadow-md rounded-l-lg" name="search-outline"></ion-icon>
                    <input class="shadow-md focus:outline-none" style="border-top: solid 1px rgb(180, 180, 180); border-bottom: solid 1px rgb(180, 180, 180);" type="number" id="search" name="search" placeholder="PESQUISA POR ID...">
                    <button class="btn shadow-md bg-cyan-900 active:shadow-inner active:bg-cyan-600 hover:bg-sky-600 rounded-r-lg">Pesquisar</button>
                </form>
            </div>
        </div>
        <div class="view-projects">
            <div class="box-project">
                <table>
                    <thead>
                        <tr>
                            <th><h2>Id</h2></th>
                            <th><h2>Descrição</h2></th>
                            <th><h2>Status</h2></th>
                            <th><h2>Data Inicial</h2></th>
                            <th><h2>Data Final</h2></th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (isset($tasks))
                        @foreach ($tasks as $task)
                            <tr>
                                <td><h2>{{$task->id}}</h2></td>
                                <td><h2>{{str_ireplace(array('&lt;b&gt;','&lt;/b&gt;','&gt;','&lt;','/','<p>','</p>', '<h2>', '</h2>', '&nbsp;', '<strong>', '</strong>', '<span>', '</span>', '<em>', '</em>', '<del>', '</del>', '<sup>', '</sup>', '<sub style="vertical-align: sub;">', '</sub>', '<sup style="vertical-align: super;">', '<span style="font-size: 12px;">', '</br>'), '', substr($task->description, 0, 40))}}...</h2></td>
                                <td><h2>{{$task->status}}</h2></td>
                                <td><h2>{{\Carbon\Carbon::parse($task->date_start)->format('d/m/Y')}}</h2></td>
                                <td><h2>{{\Carbon\Carbon::parse($task->date_limit)->format('d/m/Y')}}</h2></td>
                                <td colspan="2">
                                    <a style="display: inline" href="{{ url("/tasks/$task->id/edit") }}">Alterar</a>
                                    <button onclick="openModalTasks({{$task->id}})">Excluir</button>
                                    <a href="{{url("/pdfTask/$task->id")}}" target="_blank">PDF</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="pagination-projects">
                    {{$tasks->links()}}
                </div>
            </div>    
        </div>
    </section>
@endsection
@foreach ($tasks as $task)
    <div class="modal-container">
        <div class="modal drop-shadow-md">
            <ion-icon name="alert-circle-outline"></ion-icon>
            <h2>Aviso!!!</h2>
            <hr />
            <span>Confirme a exclusão, caso confirmado, o registro será apagado permanentemente.</span>
            <hr />
            <div class="btns">
                <form style="display: inline" action="{{ url('/tasks/'.$task->id) }}" id="del-aviso" method="POST" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <button class="btnOK drop-shadow-md" type="submit">Confirmar</button>
                </form>
                <button class="btnClose drop-shadow-md" onclick="closeModalTasks()">Cancelar</button>
            </div>
        </div>
    </div>
@endforeach
@if ($errors->any())
    <div class="box-alert">
        <div class="alert rounded-md drop-shadow-lg">
            <ion-icon name="alert-circle-outline"> </ion-icon>
            <h2>ERRO!!!</h2>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            <button class="btn drop-shadow-lg"><a href="{{ url('/projects') }}">OK</a></button>
        </div>
    </div>
@endif

