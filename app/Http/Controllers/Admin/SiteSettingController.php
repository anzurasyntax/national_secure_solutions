<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        $setting = SiteSetting::query()->first();

        return view('admin.site-settings.edit', [
            'setting' => $setting ?? new SiteSetting(SiteSetting::defaultAttributes()),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:255'],
            'location' => ['required', 'string', 'max:2000'],
            'working_time' => ['required', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'string', 'max:2048'],
            'x_url' => ['nullable', 'string', 'max:2048'],
            'youtube_url' => ['nullable', 'string', 'max:2048'],
            'instagram_url' => ['nullable', 'string', 'max:2048'],
            'pinterest_url' => ['nullable', 'string', 'max:2048'],
        ]);

        foreach (['facebook_url', 'x_url', 'youtube_url', 'instagram_url', 'pinterest_url'] as $field) {
            $val = $validated[$field] ?? null;
            $validated[$field] = ($val === null || trim((string) $val) === '') ? null : trim((string) $val);
        }

        $existing = SiteSetting::query()->first();

        if ($existing !== null) {
            $existing->update($validated);
        } else {
            SiteSetting::query()->create($validated);
        }

        SiteSetting::forgetResolved();

        return redirect()
            ->route('admin.site-settings.edit')
            ->with('status', 'Site details saved.');
    }
}
