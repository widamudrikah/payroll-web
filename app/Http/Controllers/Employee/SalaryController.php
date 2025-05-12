<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Attandance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $employee = Employee::where('user_id', $user->id)->first();

        // Jika tidak ditemukan, kembalikan error view atau redirect
        if (!$employee) {
            return back()->with('error', 'Data karyawan tidak ditemukan.');
        }

        // Validasi dan fallback bulan & tahun
        $month = (int) $request->input('month') ?: now()->month;
        $year = (int) $request->input('year') ?: now()->year;

        // Pastikan bulan dan tahun valid
        if ($month < 1 || $month > 12 || $year < 2000 || $year > now()->year + 1) {
            return back()->with('error', 'Bulan atau tahun tidak valid.');
        }

        try {
            $start = Carbon::createFromDate($year, $month, 1)->startOfDay();
            $end = Carbon::createFromDate($year, $month, 25)->endOfDay();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses tanggal.');
        }

        $presentCount = Attandance::where('user_id', $user->id)
            ->whereBetween('created_at', [$start, $end])
            ->where('status', 'hadir')
            ->count();

        $dailySalary = $employee->gaji_pokok;
        $totalSalary = round($dailySalary * $presentCount, 2);

        return view('employee.salary.index', compact('month', 'year', 'presentCount', 'employee', 'totalSalary'));
    }

    public function donwnloadPdf($id) {
$employee = Employee::where('user_id', $id)->firstOrFail();
        $month = now()->month;
        $year = now()->year;

        $start = Carbon::create($year, $month, 1)->startOfDay();
        $end = Carbon::create($year, $month, 25)->endOfDay();

        $presentCount = Attandance::where('user_id', $id)
            ->whereBetween('created_at', [$start, $end])
            ->where('status', 'hadir')
            ->count();

        $dailySalary = $employee->gaji_pokok;
        $totalSalary = round($dailySalary * $presentCount, 2);

        $pdf = PDF::loadView('employee.salary.slip', compact('employee', 'month', 'year', 'presentCount', 'totalSalary'));
        return $pdf->download('slip_gaji_'.$employee->user->name.'.pdf');
    }
}
