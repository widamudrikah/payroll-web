<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Attandance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayRollController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $start = Carbon::create($year, $month, 1)->startOfDay();
        $end = Carbon::create($year, $month, 25)->endOfDay();

        $employees = Employee::with('user')->get();

        $payrolls = $employees->map(function ($employee) use ($start, $end) {
            $presentDays = Attandance::where('user_id', $employee->user_id)
                ->whereBetween('created_at', [$start, $end])
                ->where('status', 'hadir')
                ->count();

            $totalSalary = $employee->gaji_pokok * $presentDays;

            return [
                'name' => $employee->user->name,
                'email' => $employee->user->email,
                'jabatan' => $employee->jabatan,
                'base_salary' => $employee->gaji_pokok,
                'present_days' => $presentDays,
                'total_salary' => $totalSalary,
            ];
        });

        return view('bendahara.payroll.index', compact('payrolls', 'month', 'year'));
    }
}
