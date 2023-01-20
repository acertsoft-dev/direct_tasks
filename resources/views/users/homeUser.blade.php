@extends('layouts.mainUsers')
@extends('layouts.main')
<link rel="stylesheet" href="/direct_tasks/public/css/homeUser.css">
@section('Title', 'DirectTarefas - Início')

@section('mainUsers')
    <section class="primarySection">
        <div class="txtH">
            <h1>Bem vindo {{ Auth::user()->name }}</h1>
        </div>
        <div class="readyTasks">
            <p>Minhas Tarefas :  <span id="viewTasks"> {{ $numTasks}}</span></p>
        </div>
        <div class="warnings">
            <table>
                <thead>
                    <tr>
                        <th>Avisos diarios</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span>Dia 29/11/2022 - </span>deixar o cartão ponto sobre a mesa do Admin</td>
                    </tr>
                    <tr>
                        <td><span>Dia 15/11/2022 - </span>será feriado e não tera espediente, somente o plantão</td>
                    </tr>
                    <tr>
                        <td><span>Dia 18/11/2022 - </span>não esquecer da reunião as 07:00</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panelTasks">
            <table>
                <thead>
                    <tr>
                        <th>Minhas tarefas</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($tasksProgress))
                        @foreach($tasksProgress as $tasksPro)
                            <tr>
                                <td><span class="hTxt"><strong class="progress"></strong>Data de finalização: {{\Carbon\Carbon::parse($tasksPro->date_limit)->format('d/m/Y')}} - </span> {{str_ireplace(array('&lt;b&gt;','&lt;/b&gt;','&gt;','&lt;','/','<p>','</p>', '<h2>', '</h2>', '&nbsp;', '<strong>', '</strong>', '<span>', '</span>', '<em>', '</em>', '<del>', '</del>', '<sup>', '</sup>', '<sub style="vertical-align: sub;">', '</sub>', '<sup style="vertical-align: super;">', '<span style="font-size: 12px;">', '</br>'), '', substr($tasksPro->description, 0, 45))}}...</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(count($tasksDelay))
                        @foreach($tasksDelay as $tasksDel)
                            <tr>
                                <td><span class="hTxt"><strong class="late"></strong> Data de finalização: {{\Carbon\Carbon::parse($tasksDel->date_limit)->format('d/m/Y')}} - </span> {{str_ireplace(array('&lt;b&gt;','&lt;/b&gt;','&gt;','&lt;','/','<p>','</p>', '<h2>', '</h2>', '&nbsp;', '<strong>', '</strong>', '<span>', '</span>', '<em>', '</em>', '<del>', '</del>', '<sup>', '</sup>', '<sub style="vertical-align: sub;">', '</sub>', '<sup style="vertical-align: super;">', '<span style="font-size: 12px;">', '</br>'), '', substr($tasksDel->description, 0, 45))}}...</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(count($tasksOpen))
                        @foreach($tasksOpen as $tasksOpe)
                        <tr>
                            <td><span class="hTxt"><strong class="opened"></strong>Data de finalização: {{\Carbon\Carbon::parse($tasksOpe->date_limit)->format('d/m/Y')}} - </span> {{str_ireplace(array('&lt;b&gt;','&lt;/b&gt;','&gt;','&lt;','/','<p>','</p>', '<h2>', '</h2>', '&nbsp;', '<strong>', '</strong>', '<span>', '</span>', '<em>', '</em>', '<del>', '</del>', '<sup>', '</sup>', '<sub style="vertical-align: sub;">', '</sub>', '<sup style="vertical-align: super;">', '<span style="font-size: 12px;">', '</br>'), '', substr($tasksOpe->description, 0, 45))}}...</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </section>
@endsection