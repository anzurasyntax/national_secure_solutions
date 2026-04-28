<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CertificateVerifyController extends Controller
{
    public function show(string $token): View
    {
        $certificate = Certificate::query()->where('verify_token', $token)->first();

        if ($certificate === null) {
            throw new NotFoundHttpException;
        }

        $certificate->load(['user', 'course']);

        $siteSetting = SiteSetting::current();

        return view('certificates.verify', compact('certificate', 'siteSetting'));
    }
}
