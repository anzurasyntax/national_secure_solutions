<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CheckoutCourseRequest;
use App\Models\Course;
use App\Services\CoursePurchaseService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CourseCheckoutController extends Controller
{
    public function __construct(
        private readonly CoursePurchaseService $purchaseService,
    ) {}

    public function create(Course $course): View
    {
        if (! $course->is_published) {
            abort(404);
        }

        return view('courses.checkout', [
            'course' => $course,
        ]);
    }

    public function store(CheckoutCourseRequest $request, Course $course): RedirectResponse
    {
        if (! $course->is_published) {
            abort(404);
        }

        $existingUser = Auth::user();

        $order = $this->purchaseService->createPendingOrder(
            $course,
            $request->validated('buyer_email'),
            $request->validated('buyer_name'),
            $existingUser
        );

        try {
            $result = $this->purchaseService->beginGatewayCheckout($order);

            return redirect()->away($result->redirectUrl);
        } catch (\Throwable $e) {
            report($e);

            $message = $e instanceof \RuntimeException
                ? $e->getMessage()
                : 'Unable to start checkout. Please try again later.';

            return back()->withInput()->withErrors([
                'checkout' => $message,
            ]);
        }
    }
}
