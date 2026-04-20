<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeCtaController extends Controller
{
    public function edit(): View
    {
        $homeCta = HomeCta::query()->first() ?? new HomeCta(HomeCta::defaultAttributes());

        return view('admin.home-cta.edit', compact('homeCta'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'headline' => ['required', 'string', 'max:500'],
            'subheading' => ['required', 'string', 'max:5000'],
            'button_label' => ['required', 'string', 'max:255'],
            'button_url' => ['required', 'string', 'max:2048'],
            'background_color' => ['required', 'string', 'max:32'],
            'background_image_path' => ['required', 'string', 'max:500'],
        ]);

        $existing = HomeCta::query()->first();
        if ($existing !== null) {
            $existing->update($validated);
        } else {
            HomeCta::query()->create($validated);
        }

        return redirect()
            ->route('admin.home-cta.edit')
            ->with('status', 'Home CTA saved.');
    }
}
