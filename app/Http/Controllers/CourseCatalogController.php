<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Contracts\View\View;

class CourseCatalogController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->where('is_published', true)
            ->orderBy('title')
            ->withCount('modules')
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course): View
    {
        if (! $course->is_published) {
            abort(404);
        }

        $course->load(['modules']);
        $course->loadCount('modules');

        return view('courses.show', compact('course'));
    }
}
