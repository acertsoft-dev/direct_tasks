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
            <h2>Tarefas no seu nome</h2>
            <span id="viewTasks">{{$numTasks}}</span>
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
                    <tr>
                        <td><span class="late"></span><span class="hTxt">Data de finalização: 10/11/2022 - </span> Finalizar novo CRM</td>
                    </tr>
                    <tr>
                        <td><span class="progress"></span><span class="hTxt">Data de finalização: 15/11/2022 - </span> Finalizar tela de inicio</td>
                    </tr>
                    <tr>
                        <td><span class="opened"></span><span class="hTxt">Data de finalização: 15/11/2022 - </span> Finalizar tela de inicio</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection