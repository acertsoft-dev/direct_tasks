@extends('layouts.mainUsers')
<link rel="stylesheet" href="/css/versionsStyle.css">
<link rel="shortcut icon" href="/imgs/acertsoft.png" type="image/png">
@section('Title', 'DirectTarefas - Versões')

@section('mainUsers')
    <section class="body-projects">
        <div class="title-project">
            <h1>DirectTarefas - Versões</h1>
        </div>
        <div class="btns-projects">
            <div class="buttons-top">
                <button class="btn rounded shadow-md bg-cyan-900 active:shadow-inner active:bg-cyan-600 hover:bg-sky-600"><a href="{{ route('createVersion') }}">Novo</a></button>
            </div>
            <div class="search-body">
                <form action="/versions" method="get" class="search-projects">
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
                    @if(count($versions))
                    <tbody>
                        @foreach ( $versions as $version )
                            <tr>
                                <td>{{$version->id}}</td>
                                <td>{{$version->name}}</td>
                                <td>{{\Carbon\Carbon::parse($version->created_at)->format('d/m/Y - h:m:s')}}</td>
                                <td>
                                    <a style="display: inline" href="{{ url("/version/$version->id/edit")}}">Alterar</a>
                                    <button onclick="openModalVersions({{$version->id}})"> Excluir </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
                <div class="pagination-projects">
                    {{$versions->links()}}
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
                <button class="btnClose drop-shadow-md" onclick="closeModalVersions()">Cancelar</button>
            </div>
        </div>
    </div>