<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Support\StudentLearningStats;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $progressRows = StudentLearningStats::enrollmentProgress($user);
        $stats = StudentLearningStats::dashboardCounts($progressRows);

        $certificates = $user->certificates()->with('course')->orderByDesc('issued_at')->get();

        return view('student.dashboard', [
            'activeNav' => 'dashboard',
            'progressRows' => $progressRows,
            'stats' => $stats,
            'certificates' => $certificates,
        ]);
    }
}
