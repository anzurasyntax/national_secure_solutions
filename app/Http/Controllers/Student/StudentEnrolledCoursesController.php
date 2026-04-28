<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Support\StudentLearningStats;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class StudentEnrolledCoursesController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $tab = $this->normalizeTab((string) request()->query('tab', 'enrolled'));

        $rows = StudentLearningStats::enrollmentProgress($user);
        $filtered = StudentLearningStats::filterTab($rows, $tab);

        $certificates = Certificate::query()
            ->where('user_id', $user->id)
            ->get()
            ->keyBy('course_id');

        return view('student.courses.enrolled', [
            'activeNav' => 'enrolled',
            'tab' => $tab,
            'progressRows' => $filtered->values()->all(),
            'allRows' => $rows,
            'certificates' => $certificates,
        ]);
    }

    private function normalizeTab(string $tab): string
    {
        return in_array($tab, ['enrolled', 'active', 'completed'], true) ? $tab : 'enrolled';
    }
}
