<?php

namespace App\Http\Controllers\Student;

use App\Enums\CourseOrderStatus;
use App\Http\Controllers\Controller;
use App\Models\CourseOrder;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class StudentOrdersController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $orders = CourseOrder::query()
            ->where(function ($q) use ($user): void {
                $q->where('user_id', $user->id)
                    ->orWhere('buyer_email', $user->email);
            })
            ->with(['course'])
            ->orderByDesc('created_at')
            ->get();

        return view('student.orders.index', [
            'activeNav' => 'orders',
            'orders' => $orders,
            'statusPaid' => CourseOrderStatus::Paid->value,
        ]);
    }
}
