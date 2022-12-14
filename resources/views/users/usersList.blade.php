@extends('layouts.mainUsers')
@extends('layouts.main')
<link rel="stylesheet" href="/css/usersListStyle.css">
@section('Title', 'DirectTarefas - Lista de Usuários')

@section('mainUsers')
<section class="body-projects">
    <div class="title-project">
        <h1>DirectTarefas - Projetos</h1>
    </div>
    <div class="btns-projects">
        <div class="buttons-top">
            <button class="btn rounded shadow-md bg-cyan-900 active:shadow-inner active:bg-cyan-600 hover:bg-sky-600"><a href="{{ route('createUser') }}">Novo</a></button>
        </div>
        <div class="search-body">
            <form action="/users" method="get" class="search-projects">
                <ion-icon style="--ionicon-stroke-width: 45px; padding: 8px; font-size: 16px; border: solid 1px rgb(180, 180, 180);" class="shadow-md rounded-l-lg" name="search-outline"></ion-icon>
                <input class="shadow-md focus:outline-none" style="border-top: solid 1px rgb(180, 180, 180); border-bottom: solid 1px rgb(180, 180, 180);" type="text" id="search" name="search" placeholder="PESQUISA...">
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
                        <th><h2>Name</h2></th>
                        <th><h2>Data de Criação</h2></th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                @if(count($users))
                <tbody>
                    @foreach ( $users as $user )
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y - h:m:s')}}</td>
                            <td>
                                <a style="display: inline" href="{{ url("/users/$user->id/edit") }}">Alterar</a>
                                <button onclick="openModalUsers({{$user->id}})"> Excluir </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
            <div class="pagination-projects">
                {{$users->links()}}
            </div>
        </div>    
    </div>
</section>
@endsection
<div class="modal-container">
    <div class="modal drop-shadow-md">
        <ion-icon name="alert-circle-outline"></ion-icon>
        <h2>Aviso!!!</h2>
        <hr />
        <span>Confirme a exclusão, caso confirmado, o registro será apagado permanentemente.</span>
        <hr />
        <div class="btns">
            <form style="display: inline" id="del-aviso" method="POST">
                @method('DELETE')
                @csrf
                <button class="btnOK drop-shadow-md" type="submit">Confirmar</button>
            </form>
            <button class="btnClose drop-shadow-md" onclick="closeModalUsers()">Cancelar</button>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="box-alert">
        <div class="alert rounded-md drop-shadow-lg">
            <ion-icon name="alert-circle-outline"> </ion-icon>
            <h2>ERRO!!!</h2>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            <button class="btn drop-shadow-lg"><a href="{{ url('/users') }}">OK</a></button>
        </div>
    </div>
@endif