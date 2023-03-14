<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ReportsController extends Controller
{
    public function ShowGenerateReports(){
        return view('reports.generateReports');
    }
}
