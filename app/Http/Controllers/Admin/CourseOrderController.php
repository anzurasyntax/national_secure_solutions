<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseOrder;
use Illuminate\Contracts\View\View;

class CourseOrderController extends Controller
{
    public function index(): View
    {
        $orders = CourseOrder::query()
            ->with(['course', 'user'])
            ->orderByDesc('created_at')
            ->paginate(25);

        return view('admin.course-orders.index', compact('orders'));
    }
}
