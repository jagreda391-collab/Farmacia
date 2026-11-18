<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Retorna la vista que movimos a principal/dashboard
        return view('principal.dashboard.index');
    }
}