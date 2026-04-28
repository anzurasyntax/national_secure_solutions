@extends('layouts.student-app')

@section('title', $pageTitle)

@section('student_content')
    <h1 class="font-heading text-3xl font-bold text-ink">{{ $pageTitle }}</h1>

    <div class="mt-10 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-600">
                    <tr>
                        <th class="px-6 py-4">Quiz Info</th>
                        <th class="px-6 py-4">Question</th>
                        <th class="px-6 py-4">Total Marks</th>
                        <th class="px-6 py-4">Correct</th>
                        <th class="px-6 py-4">Incorrect</th>
                        <th class="px-6 py-4">Earned Marks</th>
                        <th class="px-6 py-4">Result</th>
                        <th class="px-6 py-4 text-right">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center text-slate-600">
                            No quiz attempts recorded yet. Module quizzes will appear here when your courses include scored assessments.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
