<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attandance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString(); // pakai WIB
    $userId = auth()->id();

    $hasCheckedInToday = Attandance::where('user_id', $userId)
        ->whereDate('created_at', $today)
        ->exists();

    $currentMonth = Carbon::now()->month;
    $attendances = Attandance::where('user_id', $userId)
        ->whereMonth('created_at', $currentMonth)
        ->get();

    return view('employee.attendance.index', compact('hasCheckedInToday', 'attendances'));
}

    public function store(Request $request)
    {
        $request->validate([]);

        Attandance::create([
            'user_id'   => Auth::id(),
            'status'    => 'Hadir',
        ]);

        return redirect()->route('attendance.index')->with('message', 'Presensi Berhasil');
    }
}
