<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Tarjetas KPI (Indicadores)
        $totalMedicines = Medicine::count();
        $totalCustomers = Customer::count();
        $totalCategories = Category::count();
        $totalSales = Sale::count();
        $totalIncome = Sale::sum('total');

        // 2. Gráfico 1: Ventas de los últimos 7 días (Líneas)
        $salesByDay = Sale::select(
            DB::raw('DATE(date) as fecha'),
            DB::raw('SUM(total) as total')
        )
        ->where('date', '>=', Carbon::now()->subDays(6)->startOfDay())
        ->groupBy('fecha')
        ->orderBy('fecha')
        ->get();

        $days = [];
        $totalsByDay = [];
        foreach($salesByDay as $sale) {
            $days[] = Carbon::parse($sale->fecha)->format('d/m');
            $totalsByDay[] = $sale->total;
        }

        // 3. Gráfico 2: Ventas por Categoría (Dona)
        $salesByCategory = DB::table('detail_sales')
            ->join('medicines', 'medicines.id', '=', 'detail_sales.medicine_id')
            ->join('categories', 'categories.id', '=', 'medicines.category_id')
            ->select('categories.name', DB::raw('SUM(detail_sales.subtotal) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();

        $categoryNames = $salesByCategory->pluck('name');
        $categoryTotals = $salesByCategory->pluck('total');

        // 4. Gráfico 3: Top 5 medicamentos más vendidos (Barras)
        $topMedicines = DB::table('detail_sales')
            ->join('medicines', 'medicines.id', '=', 'detail_sales.medicine_id')
            ->select('medicines.name', DB::raw('SUM(detail_sales.amount) as total_vendido'))
            ->groupBy('medicines.name')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        $medNames = $topMedicines->pluck('name');
        $medTotals = $topMedicines->pluck('total_vendido');

        return view('principal.dashboard.index', compact(
            'totalMedicines', 'totalCustomers', 'totalCategories', 'totalSales', 'totalIncome',
            'days', 'totalsByDay', 'categoryNames', 'categoryTotals', 'medNames', 'medTotals'
        ));
    }
}