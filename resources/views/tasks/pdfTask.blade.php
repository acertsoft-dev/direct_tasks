<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="imgs/acertsoft.png" type="image/png">
    <title>Task PDF</title>
    <style>
        body{
            font-family: sans-serif;
        }
        table{
            border: 1px solid gray; 
            width: 100%;
            height: 1025px;
            /* height: 1025px; */
        }
        table thead{
            border-bottom: 1px solid gray;
            padding-bottom: 10px;
        }
        table thead tr th{
            /* border: 1px solid gray; */
        }
        table thead tr th p{
            text-align: left;
        }
        table thead tr th img{
            width: 90px;
            top: 40px;
            left: 50px;
            transform: translate(-50%, -50%);
            position: fixed;
            /* border: 1px solid gray; */
        }
        /* .page-break {
            page-break-after: always;
        } */
        td, th{
            /* border: 1px solid gray; */
            height: 10px;
        }
        .td-description{
            padding: 10px;
            height: 300px;
            text-align: start;
        }
        .td-description p{
            height: 280px;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr class="tr1">
                <th rowspan="3"><img src="imgs/acertsoft.png"></th>
                <th colspan="3">Check-in da tarefa {{$task->id}}</th>
            </tr>
            <tr class="tr2">
                <td>Situação: {{$task->status}}</td>
                <td>Serviço: {{$task->service}}</td>
                <td>Data inicial: {{\Carbon\Carbon::parse($task->date_start)->format('d/m/Y')}}</td>
            </tr>
            <tr>
                <td colspan="2">Responsavel: {{$user->name}}</td>
                <td>Data final: {{\Carbon\Carbon::parse($task->date_limit)->format('d/m/Y')}}</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="td-description"><p>Descrição: {{str_ireplace(array('&amp;'),'&',(str_ireplace(array('&lt;'),'>',(str_ireplace(array('&gt;'), '<', (str_ireplace(array('&lt;b&gt;','&lt;/b&gt;','<p>','</p>', '<h2>', '</h2>', '&nbsp;', '<strong>', '</strong>', '<span>', '</span>', '<em>', '</em>', '<del>', '</del>', '<sup>', '</sup>', '<sub style="vertical-align: sub;">', '</sub>', '<sup style="vertical-align: super;">', '<span style="font-size: 12px;">', '</br>'), '', $task->description)))))))}}</p></td>
            </tr>
        </tbody>
    </table>


    {{-- <div class="page-break"></div> --}}
</body>
</html>