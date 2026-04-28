<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();

        return view('student.profile.show', [
            'activeNav' => 'profile',
            'user' => $user,
        ]);
    }
}
