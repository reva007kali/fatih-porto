<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Project;
use App\Models\Website;
use App\Models\Service;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $visitorStats = Session::select(
            DB::raw("DATE(datetime(last_activity, 'unixepoch')) as date"),
            DB::raw('count(*) as visitors')
        )
        ->where('last_activity', '>=', Carbon::now()->subDays(7)->timestamp)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get()
        ->pluck('visitors', 'date')
        ->toArray();

        $visitorData = [];
        $visitorLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateString = $date->format('Y-m-d');
            $visitorLabels[] = $date->format('D');
            $visitorData[] = $visitorStats[$dateString] ?? 0;
        }

        return view('livewire.admin.dashboard', [
            'totalProjects' => Project::count(),
            'totalWebsites' => Website::count(),
            'totalServices' => Service::count(),
            'totalMessages' => ContactMessage::count(),
            'totalTestimonials' => Testimonial::count(),
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
            'visitorCount' => array_sum($visitorData),
            'visitorChartData' => $visitorData,
            'visitorChartLabels' => $visitorLabels,
        ])->layout('layouts.app', ['header' => 'Dashboard']);
    }
}
