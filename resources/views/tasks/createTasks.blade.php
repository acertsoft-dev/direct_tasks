@extends('layouts.mainUsers')
<link rel="stylesheet" href="/direct_tasks/public/css/createStyle.css">
<link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
@section('Title', 'DirectTarefas - Tarefas')

@section('mainUsers')
    <section class="right-page">
        <h2 class="h2">@if(isset($task)) Ateração de Tarefas @else Cadastro de Tarefas @endif</h2>
        <div class="formFron">
            @if(isset($task))
                <form action="{{ url("/tasks/$task->id") }}" method="POST" enctype="multipart/form-data">
                @method("PUT")
            @else
                <form action="{{ route('createTaskEnd') }}" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="form-inputs">
                    <div class="div-form">
                        <div class="inputs-primary">
                            <label>Id:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if (isset($task))
                                    <input type="number" placeholder="{{$task->id}}" disabled>
                                @else
                                    <input type="number" placeholder="id" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="inputs-primary">
                            <label for="id_project">Projeto:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <select type="text" name="id_project" id="id_project" required onchange="openVersion(this.value, {{$versions_projects}})">
                                        <option value="{{$task->id_project}}" selected hidden>
                                            @foreach($projects as $project)
                                                @if($project->id == $task->id_project)
                                                    {{$project->name}}
                                                @endif
                                            @endforeach
                                        </option>
                                        @if(isset($projects))
                                            @foreach ($projects as $project)
                                                <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                @else
                                    <select type="text" name="id_project" id="id_project" required onchange="openVersion(this.value, {{$versions_projects}})">
                                        <option value="" disabled selected hidden>Nenhum</option>
                                        @if(isset($projects))
                                            @foreach ($projects as $project)
                                                <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="inputs-primary">
                            <label for="id_version">Versão:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <select name="text" name="id_version" id="id_version" required>
                                        <option value="{{$task->id_version}}" selected hidden>
                                            @foreach($versions_projects as $version_project)
                                                @if($version_project->id == $task->id_version)
                                                    {{$version_project->name}}
                                                @endif
                                            @endforeach
                                        </option>
                                    </select>
                                @else
                                    <select disabled type="text" name="id_version" id="id_version" required onchange="cons(this.value)">
                                        <option value="" disabled selected hidden>Nenhum</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="div-form">
                        <div class="inputs-primary">
                            <label for="service">Serviço:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <select type="text" name="service" id="service" required>
                                        <option value="{{$task->service}}" selected hidden>{{$task->service}}</option>
                                        <option value="Desenvolvimento">Desenvolvimento</option>
                                        <option value="Correção">Correção</option>
                                        <option value="Melhoria">Melhoria</option>
                                    </select>
                                @else
                                    <select type="text" name="service" id="service" required>
                                        <option value="Desenvolvimento">Desenvolvimento</option>
                                        <option value="Correção">Correção</option>
                                        <option value="Melhoria">Melhoria</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="inputs-primary">
                            <label for="date_start">Data inicial:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <input type="date" name="date_start" id="date_start" required value="{{$task->date_start}}" max="9999-12-31">
                                @else
                                    <input type="date" name="date_start" id="date_start" onchange="trasValor(this.value)" required value="{{$nowDate}}" max="9999-12-31">
                                @endif
                            </div>
                        </div>
                        <div class="inputs-primary">
                            <label for="date_limit">Data final:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <input type="date" name="date_limit" id="date_limit" required value="{{$task->date_limit}}" max="9999-12-31">
                                @else
                                    <input type="date" name="date_limit" id="date_limit" onchange="trasValor(this.value)" required max="9999-12-31">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="div-form">
                        <div class="inputs-primary">
                            <label for="id_user">Usuário:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <select type="text" name="id_user" id="id_user" required>
                                        <option value="{{$task->id_user}}" selected hidden>
                                            @foreach($users as $user)
                                                @if($user->id == $task->id_user)
                                                    {{$user->name}}
                                                @endif
                                            @endforeach
                                        </option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select type="text" name="id_user" id="id_user" required>
                                        <option hidden selected value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                                        @if(isset($users))
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="inputs-primary">
                            <label for="status">Status:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <select type="text" name="status" id="status" required onchange="openSolution(this.value)">
                                        <option value="{{$task->status}}" selected hidden>{{$task->status}}</option>
                                        <option value="Em aberto">Em aberto</option>
                                        <option value="Em andamento">Em andamento</option>
                                        <option value="Concluida">Concluida</option>
                                    </select>
                                @else
                                    <select type="text" name="status" id="status" required onchange="openSolution(this.value)">
                                        <option value="Em aberto">Em aberto</option>
                                        <option value="Em andamento">Em andamento</option>
                                        <option value="Concluida">Concluida</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="inputs-primary" id="visible">
                            @if (isset($task))
                                <label for="file" id="labelFile">Arquivos:</label>
                                <div class="div-inputs">
                                    <div class="inputs-seg">
                                        <span>
                                            <ion-icon name="create-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <label for="file" id="files">Enviar arquivos</label>
                                    <input type="file" name="file[]" id="file" multiple onchange="previewFiles()">
                                </div>
                            @else
                                <label for="file" id="labelFile">Arquivos:</label>
                                <div class="div-inputs">
                                    <div class="inputs-seg">
                                        <span>
                                            <ion-icon name="create-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <label for="file" id="files">Enviar arquivos</label>
                                    <input type="file" name="file[]" id="file" multiple onchange="previewFiles()">
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(isset($task))
                        <div class="div-form" id="invisible" style="display: flex">
                            <div class="inputs-primary" style="width: 90%">
                                <label>Arquivos vinculados a tarefa:</label>
                                <div id="preview">
                                    <table id="tableDow">
                                        @foreach ($arrayFiles as $file)
                                            <tr>
                                                <td><a href="{{ url("/download/$file") }}" target="_blank">{{$file}}</a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="div-form" id="invisible" style="display: block">
                            <div class="inputs-primary" style="width: 90%">
                                <label>Arquivos para upload:</label>
                                <div id="preview">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="div-form">
                        <div class="inputs-primary text-input">
                            <label for="description">Descrição:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon class="required-icon" name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if(isset($task))
                                    <textarea name="description" id="description" cols="30" rows="3" required>{{$task->description}}</textarea>
                                @else
                                    <textarea name="description" id="description" cols="30" rows="3" required></textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="div-form">
                        <div class="inputs-primary text-input">
                            <label for="solution">Solução:</label>
                            <div class="div-inputs">
                                <div class="inputs-seg">
                                    <span>
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                @if (isset($task))
                                    @if ($task->solution != null)
                                        <textarea name="solution" id="solution" cols="30" rows="3">{{$task->solution}}</textarea>
                                    @else
                                        <textarea name="solution" id="solution" cols="30" rows="3" disabled></textarea>
                                    @endif
                                @else
                                    <textarea name="solution" id="solution" cols="30" rows="3" disabled></textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btns-end">
                    <div class="btns-start">

                        <textarea name="temp" id="temp"></textarea>

                        <input type="button" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" onclick="iniciaContagem()" value="Iniciar"> 

                        <input type="button" class="inline-flex justify-center rounded-md border border-transparent bg-gray-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2" onclick="pausaContagem()" value="Pausar">
                        
                        <input type="button" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" onclick="finalizaContagem()" value="Parar">

                    </div>
                    <div class="buttons-end px-4 py-3 text-right sm:px-6">
                        <a type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" href="{{ url("/tasks")}}">Cancelar</a>

                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Salvar</button>                 
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
