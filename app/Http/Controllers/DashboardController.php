<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use App\Models\VoucherClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filters
        $startDate = $request->input('start_date') ? \Carbon\Carbon::parse($request->input('start_date'))->startOfDay() : now()->subDays(6)->startOfDay();
        $endDate = $request->input('end_date') ? \Carbon\Carbon::parse($request->input('end_date'))->endOfDay() : now()->endOfDay();
        $search = $request->input('search');

        // 1. Visitor Statistics (Filtered)
        $totalVisits = PageVisit::whereBetween('visited_at', [$startDate, $endDate])->count();
        $todayVisits = PageVisit::whereDate('visited_at', today())->count(); // Keep absolute logic for "Today"
        $thisWeekVisits = PageVisit::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Visits by Page (Filtered + Paginated)
        $pageVisits = PageVisit::whereBetween('visited_at', [$startDate, $endDate])
            ->select('page_url', DB::raw('count(*) as total'))
            ->groupBy('page_url')
            ->orderByDesc('total')
            ->paginate(10, ['*'], 'pages_page')
            ->appends($request->all());

        // Recent Visitors (Filtered + Paginated)
        $recentVisitors = PageVisit::whereBetween('visited_at', [$startDate, $endDate])
            ->orderByDesc('visited_at')
            ->paginate(10, ['*'], 'visits_page')
            ->appends($request->all());

        // 2. Registered Users (Filtered + Search + Paginated)
        $queryClaims = VoucherClaim::with('voucherCode')
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($search) {
            $queryClaims->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $totalClaims = $queryClaims->count();
        $recentClaims = $queryClaims->orderByDesc('created_at')
            ->paginate(10, ['*'], 'claims_page')
            ->appends($request->all());

        // 3. Trends (Dynamic for Chart)
        $dates = collect();
        $diffInDays = $startDate->diffInDays($endDate);
        
        // Limit chart points if range is too large (e.g. > 30 days, group by week/month could be next step, but let's stick to days for now)
        for ($i = 0; $i <= $diffInDays; $i++) {
            $dates->push($startDate->copy()->addDays($i)->format('Y-m-d'));
        }

        $visitTrend = PageVisit::select(DB::raw('DATE(visited_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('visited_at', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('count', 'date');

        $claimTrend = VoucherClaim::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('count', 'date');

        $chartData = [
            'labels' => $dates,
            'visits' => $dates->map(fn($date) => $visitTrend[$date] ?? 0),
            'claims' => $dates->map(fn($date) => $claimTrend[$date] ?? 0),
        ];

        return view('admin.dashboard', compact(
            'totalVisits',
            'todayVisits',
            'thisWeekVisits',
            'pageVisits',
            'recentVisitors',
            'totalClaims',
            'recentClaims',
            'chartData',
            'startDate',
            'endDate',
            'search'
        ));
    }
}
