<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasheerController extends Controller
{
    //
    public function index() {
        return view('casheer.index'); // Tampilkan Blade hasil integrasi
    }

}
