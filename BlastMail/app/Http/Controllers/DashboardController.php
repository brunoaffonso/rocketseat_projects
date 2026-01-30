<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $subscribersCount = Subscriber::count();
        $listsCount = EmailList::count();
        $campaignsCount = Campaign::count();

        $recentCampaigns = Campaign::with('emailList')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentSubscribers = Subscriber::with('emailList')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Subscriber growth over last 15 days
        $growthData = Subscriber::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as aggregate'))
            ->where('created_at', '>=', now()->subDays(15))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard', compact(
            'subscribersCount',
            'listsCount',
            'campaignsCount',
            'recentCampaigns',
            'recentSubscribers',
            'growthData'
        ));
    }
}
