<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;

class ExcelController extends Controller
{
    public function readExcel()
{
    $filePath = public_path('assets/excel/OVZ New Price Hike - 2025.xlsx'); // Change this path
    Excel::import(new DataImport, $filePath);
}
}
