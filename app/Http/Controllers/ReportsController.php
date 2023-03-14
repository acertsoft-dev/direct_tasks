<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    public function ShowGenerateReports(){
        return view('reports.generateReports');
    }

    public function ShowReport(){
        $dados = [
            'nome' => 'Wesley',
            'idade' => '21',
            'cidade' => 'Capão da Canoa'
        ];

        $pdf = Pdf::loadView('reports.report', compact('dados'));
        
        return $pdf->stream('Relatório_Personalizado.pdf');
    }
}