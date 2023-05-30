<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function revenue(Request $request){

        $currentMonthRevenue = Revenue::whereMonth('date', Carbon::now()->month)->sum('amount');

        // Get the previous week's revenue
        $previousWeekRevenue = Revenue::whereBetween('date', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        ])->sum('amount');

        // Calculate the revenue percentage
        $revenuePercentage = ($currentMonthRevenue - $previousWeekRevenue) / $previousWeekRevenue * 100;

        // Prepare the data for the JSON response
        $data = [
            'revenue' => $currentMonthRevenue,
            'revenuePercentage' => round($revenuePercentage, 2),
            'revenueComparison' => $currentMonthRevenue - $previousWeekRevenue,
        ];

        return view('ase.content.revenue', $data);
    }
}
