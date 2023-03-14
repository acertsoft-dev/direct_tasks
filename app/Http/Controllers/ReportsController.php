<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;


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

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('report', $dados)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('report.pdf');
    }
}