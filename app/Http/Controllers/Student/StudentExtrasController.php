<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class StudentExtrasController extends Controller
{
    public function reviews(): View
    {
        return view('student.extras.placeholder', [
            'activeNav' => 'reviews',
            'pageTitle' => 'Reviews',
            'message' => 'You have not submitted any course reviews yet. Complete a course and share your feedback.',
        ]);
    }

    public function quizAttempts(): View
    {
        return view('student.extras.quiz-placeholder', [
            'activeNav' => 'quiz_attempts',
            'pageTitle' => 'My Quiz Attempts',
        ]);
    }

    public function wishlist(): View
    {
        return view('student.extras.placeholder', [
            'activeNav' => 'wishlist',
            'pageTitle' => 'Wishlist',
            'message' => 'Saved courses will appear here. Browse the catalog and tap “Add to cart” on courses you like.',
        ]);
    }

    public function qa(): View
    {
        return view('student.extras.placeholder', [
            'activeNav' => 'qa',
            'pageTitle' => 'Question & Answer',
            'message' => 'No conversations yet. When instructors enable Q&A on your courses, threads will show up here.',
        ]);
    }
}
