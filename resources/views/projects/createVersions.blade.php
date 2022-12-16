@extends('layouts.mainUsers')
@extends('layouts.main')
<link rel="stylesheet" href="/direct_tasks/public/css/createStyle.css">
@section('Title', 'DirectTarefas - Cadastrar Versão')

@section('mainUsers')
    <section class="right-page">
        <h2 class="h2">@if(isset($version)) Edição de Versões @else Cadastro de Versões @endif</h2>
        <div class="formFron">
            @if(isset($version))
                <form action="{{ url("version/$version->id")}}" method="POST">
                @method("PUT")
            @else
                <form action="{{ url('createVersion') }}" method="POST">
            @endif
                @csrf
                <div class="form-inputs">
                    <div class="div-form">
                        <div class="inputs-primary">
                            <label for="id">Código:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($version))
                                    <input type="text" name="id" id="id" disabled placeholder="{{$version->id}}">
                                @else
                                    <input type="text" name="id" id="id" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="inputs-primary">
                            <label for="version">Nome:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($version))
                                    <input type="text" name="name" id="version" placeholder="Nome da versão" value="{{$version->name}}">
                                @else
                                    <input type="text" name="name" id="version" placeholder="Nome da versão">
                                @endif
                            </div>
                        </div>
                        <div class="inputs-primary">
                            <label for="project_id">Projetos:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                <select id="project_id" name="project_id" autocomplete="country-name">
                                @if(isset($version))
                                    @if(count($projects))
                                        <option value="{{$version->project_id}}">{{$versionProject->name}}</option>
                                        @foreach ($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    @endif
                                @else
                                    @if(count($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    @endif
                                @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="div-form">
                        <div class="inputs-primary text-input">
                            <label for="comments">Observações:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($version))
                                <textarea id="comments" name="comments" cols="30" rows="6" placeholder="Obs:">{{$version->comments}}</textarea>
                                @else
                                <textarea id="comments" name="comments" cols="30" rows="6" placeholder="Obs:"></textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons-end px-4 py-3 text-right sm:px-6">
                    <a type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" href="{{ url("/versions")}}">Cancelar</a>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Salvar</button>                 
                </div>
            </form>
        </div>
    </section>
@endsection


@if ($errors->any())
    <div class="box-alert">
        <div class="alert rounded-md drop-shadow-lg">
            <ion-icon name="alert-circle-outline"> </ion-icon>
            <h2>ERRO!!!</h2>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            @if(isset($version))
                <button class="btn drop-shadow-lg"><a href="{{ url("/version/$version->id/edit")}}">OK</a></button>
            @else
                <button class="btn drop-shadow-lg"><a href="{{ url('/createVersion') }}">OK</a></button>
            @endif
        </div>
    </div>
@endif

<script src="/direct_tasks/public/js/scriptsVersions.js"></script>