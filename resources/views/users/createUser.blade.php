@extends('layouts.mainUsers')
@extends('layouts.main')
<link rel="stylesheet" href="/direct_tasks/public/css/createStyle.css">
@section('Title', 'DirectTarefas - Cadastrar Usuários')

@section('mainUsers')

<section class="right-page">
    <h2 class="h2">@if(isset($user))Edição de Usuários @else Cadastro de Usuários @endif</h2>
    <div class="formFron">
        @if(isset($user))
            <form action="{{url("/users/$user->id")}}" method="POST">
                @method("PUT")
        @else
            <form action="{{ url('/createUser') }}" method="POST">
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
                            @if(isset($user))
                                <input type="text" name="id" id="id" placeholder="{{$user->id}}" disabled>
                            @else
                                <input type="text" name="id" id="id" disabled>
                            @endif
                        </div>
                    </div>
                    <div class="inputs-primary">
                        <label for="name">Nome:</label>
                        <div class="div-inputs">
                            <div class="inputs-seg">
                                <span>
                                    <ion-icon name="create-outline"></ion-icon>
                                </span>
                            </div>
                            @if(isset($user))
                                <input type="text" name="name" id="name" placeholder="Nome" value="{{$user->name}}">
                            @else
                                <input type="text" name="name" id="name" placeholder="Nome">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="div-form">
                    <div class="inputs-primary">
                        <label for="email">E-mail:</label>
                        <div class="div-inputs">
                            <div class="inputs-seg">
                                <span>
                                    <ion-icon name="create-outline"></ion-icon>
                                </span>
                            </div>
                            @if(isset($user))
                                <input type="text" name="email" id="email" placeholder="E-mail" value="{{$user->email}}">
                            @else
                                <input type="text" name="email" id="email" placeholder="E-mail">
                            @endif
                        </div>
                    </div>
                    @if(isset($user))
                
                    @else
                    <div class="inputs-primary">
                        <label for="password">Senha:</label>
                        <div class="div-inputs">
                            <div class="inputs-seg">
                                <span>
                                    <ion-icon name="create-outline"></ion-icon>
                                </span>
                            </div>
                            <input type="text" name="password" id="password" placeholder="Senha">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="px-4 py-3 text-right sm:px-6">
                <a type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" href="{{ url("/users")}}">Cancelar</a>
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
        @if(isset($user))
            <button class="btn drop-shadow-lg"><a href="{{ url("/users/$user->id/edit")}}"></a></button>
        @else
            <button class="btn drop-shadow-lg"><a href="{{ url('/users') }}">OK</a></button>
        @endif
    </div>
</div>
@endif