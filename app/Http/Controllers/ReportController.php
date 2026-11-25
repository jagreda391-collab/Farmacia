<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['customer', 'user', 'details.medicine.category']);

        // Filtros
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']);
        }
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $sales = $query->orderBy('date', 'desc')->get();

        // Cálculos de las tarjetas
        $totalSales = $sales->count();
        $totalIncome = $sales->sum('total');
        $totalIgv = $sales->sum('igv');
        $averageSale = $totalSales > 0 ? $totalIncome / $totalSales : 0;

        // Datos para el gráfico de barras (Total vendido por día)
        $salesByDay = $sales->groupBy(function($sale) {
            return $sale->date->format('d/m/Y');
        })->map(function($group) {
            return $group->sum('total');
        })->sortKeys();

        $days = $salesByDay->keys();
        $totalsByDay = $salesByDay->values();

        // Datos para los select del formulario
        $customers = Customer::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('settings.reports.index', compact(
            'sales', 'totalSales', 'totalIncome', 'totalIgv', 'averageSale', 
            'days', 'totalsByDay', 'customers', 'users', 'categories'
        ));
    }
}