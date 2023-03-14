@extends('layouts.mainUsers')
@extends('layouts.main')
<link rel="stylesheet" href="/directTasks/public/css/reports.css">
<link rel="stylesheet" href="/directTasks/public/css/createStyle.css">
@section('Title', 'DirectTarefas - Relatórios')

@section('mainUsers')
    <section class="right-page">
        <h2 class="h2">Gerador de Relatórios</h2>
        <div class="formFron">
                <form action="{{ url('createProject') }}" method="POST">
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
                                <input type="text" name="id" id="id" disabled>
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
                                <input type="text" name="name" id="name" placeholder="Nome do projeto">
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
                                <textarea id="comments" name="comments" cols="30" rows="6" placeholder="Obs:"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right sm:px-6">
                    <a type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" href="{{ url("/projects")}}">Cancelar</a>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Salvar</button>                 
                </div>
            </form>
        </div>
    </section>
@endsection