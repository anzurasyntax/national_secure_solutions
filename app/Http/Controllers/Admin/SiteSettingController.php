<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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
            'logo' => ['nullable', 'image', 'max:5120'],
            'remove_logo' => ['sometimes', 'boolean'],
        ]);

        foreach (['facebook_url', 'x_url', 'youtube_url', 'instagram_url', 'pinterest_url'] as $field) {
            $val = $validated[$field] ?? null;
            $validated[$field] = ($val === null || trim((string) $val) === '') ? null : trim((string) $val);
        }

        unset($validated['logo'], $validated['remove_logo']);

        $existing = SiteSetting::query()->first();

        if ($request->boolean('remove_logo')) {
            if ($existing !== null && $existing->logo_path !== null && $existing->logo_path !== '') {
                $this->deleteStoredLogo($existing->logo_path);
            }
            $validated['logo_path'] = null;
        } elseif ($request->hasFile('logo')) {
            $newPath = $this->storeLogo($request->file('logo'));
            if ($existing !== null && $existing->logo_path !== null && $existing->logo_path !== '') {
                $this->deleteStoredLogo($existing->logo_path);
            }
            $validated['logo_path'] = $newPath;
        }

        if ($existing !== null) {
            $existing->update($validated);
        } else {
            SiteSetting::query()->create($validated);
        }

        SiteSetting::forgetResolved();

        return redirect()
            ->route('admin.site-settings.edit')
            ->with('status', 'CMS settings saved.');
    }

    private function storeLogo(UploadedFile $file): string
    {
        $dir = public_path('img/site');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');
        $filename = 'logo-'.Str::lower(Str::random(12)).'.'.$extension;
        $file->move($dir, $filename);

        return 'img/site/'.$filename;
    }

    private function deleteStoredLogo(?string $path): void
    {
        if ($path === null || $path === '' || ! str_starts_with($path, 'img/site/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
