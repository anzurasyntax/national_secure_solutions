<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    public function edit(): View
    {
        $about = AboutPage::query()->first();

        return view('admin.about-page.edit', [
            'about' => $about ?? new AboutPage(AboutPage::defaultAttributes()),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_image' => ['nullable', 'image', 'max:5120'],
            'brand_title' => ['required', 'string', 'max:255'],
            'brand_intro' => ['required', 'string', 'max:20000'],
            'mission_title' => ['required', 'string', 'max:255'],
            'mission_body' => ['required', 'string', 'max:20000'],
            'vision_title' => ['required', 'string', 'max:255'],
            'vision_body' => ['required', 'string', 'max:20000'],
            'memberships_heading' => ['required', 'string', 'max:255'],
            'memberships_body' => ['required', 'string', 'max:20000'],
            'leadership_heading' => ['required', 'string', 'max:255'],
            'leadership_body' => ['required', 'string', 'max:20000'],
            'statement_heading' => ['required', 'string', 'max:20000'],
            'statement_list' => ['required', 'string', 'max:20000'],
            'statement_footer' => ['required', 'string', 'max:20000'],
            'founder_heading' => ['required', 'string', 'max:255'],
            'founder_subtitle' => ['required', 'string', 'max:255'],
            'founder_body' => ['required', 'string', 'max:30000'],
            'chairman_heading' => ['required', 'string', 'max:255'],
            'chairman_subtitle' => ['required', 'string', 'max:255'],
            'chairman_body' => ['required', 'string', 'max:30000'],
            'president_heading' => ['required', 'string', 'max:255'],
            'president_subtitle' => ['required', 'string', 'max:255'],
            'president_body' => ['required', 'string', 'max:30000'],
        ]);

        unset($validated['hero_image']);

        $existing = AboutPage::query()->first();

        if ($request->hasFile('hero_image')) {
            $this->deleteAboutHeroImageIfManaged($existing?->hero_image_path);
            $validated['hero_image_path'] = $this->storeAboutHeroImage($request->file('hero_image'));
        } else {
            $validated['hero_image_path'] = $existing?->hero_image_path ?? 'img/about_us.jpg';
        }

        if ($existing !== null) {
            $existing->update($validated);
        } else {
            AboutPage::query()->create($validated);
        }

        return redirect()
            ->route('admin.about-page.edit')
            ->with('status', 'About page saved.');
    }

    private function storeAboutHeroImage(\Illuminate\Http\UploadedFile $file): string
    {
        $dir = public_path('img/about');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $basename ?? 'about');
        $basename = trim($basename, '-') ?: 'about';
        $filename = $basename.'-'.uniqid('', true).'.'.$extension;

        $file->move($dir, $filename);

        return 'img/about/'.$filename;
    }

    private function deleteAboutHeroImageIfManaged(?string $path): void
    {
        if ($path === null || $path === '' || ! str_starts_with($path, 'img/about/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
