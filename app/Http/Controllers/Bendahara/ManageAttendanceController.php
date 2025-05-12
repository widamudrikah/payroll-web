<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Attandance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageAttendanceController extends Controller
{

    public function index(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
    
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->day(25)->endOfDay();
    
        $attendances = Attandance::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('bendahara.attendance.index', compact('attendances', 'month', 'year'));
    }
}
