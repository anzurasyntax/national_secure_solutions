<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(): View
    {
        $slides = HeroSlide::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create(): View
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'headline' => ['required', 'string', 'max:1000'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'button_label' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'string', 'max:2048'],
        ]);

        $validated['image_path'] = $this->storeUploadedImage($request->file('image'));
        unset($validated['image']);

        $validated['sort_order'] = $validated['sort_order'] ?? (((int) (HeroSlide::query()->max('sort_order') ?? 0)) + 1);
        $validated['button_label'] = $validated['button_label'] ?: 'Get Inquiry';
        $validated['button_url'] = $validated['button_url'] ?? '#';
        $validated['tagline'] = $validated['tagline'] !== null && trim($validated['tagline']) === '' ? null : $validated['tagline'];
        $validated['subtitle'] = $validated['subtitle'] !== null && trim($validated['subtitle']) === '' ? null : $validated['subtitle'];

        HeroSlide::query()->create($validated);

        return redirect()->route('admin.hero-slides.index')->with('status', 'Slide created.');
    }

    public function edit(HeroSlide $hero_slide): View
    {
        return view('admin.hero-slides.edit', ['slide' => $hero_slide]);
    }

    public function update(Request $request, HeroSlide $hero_slide): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'headline' => ['required', 'string', 'max:1000'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'button_label' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'string', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $this->deleteStoredImageIfUploaded($hero_slide->image_path);
            $validated['image_path'] = $this->storeUploadedImage($request->file('image'));
        }

        unset($validated['image']);

        $validated['button_label'] = ($validated['button_label'] ?? '') !== '' ? $validated['button_label'] : 'Get Inquiry';
        $validated['button_url'] = $validated['button_url'] ?? '#';
        $validated['tagline'] = isset($validated['tagline']) && trim((string) $validated['tagline']) === '' ? null : ($validated['tagline'] ?? null);
        $validated['subtitle'] = isset($validated['subtitle']) && trim((string) $validated['subtitle']) === '' ? null : ($validated['subtitle'] ?? null);

        $hero_slide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('status', 'Slide updated.');
    }

    public function destroy(HeroSlide $hero_slide): RedirectResponse
    {
        $this->deleteStoredImageIfUploaded($hero_slide->image_path);
        $hero_slide->delete();

        return redirect()->route('admin.hero-slides.index')->with('status', 'Slide deleted.');
    }

    private function storeUploadedImage(\Illuminate\Http\UploadedFile $file): string
    {
        $dir = public_path('img/hero');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $basename ?? 'slide');
        $basename = trim($basename, '-') ?: 'slide';
        $filename = $basename.'-'.uniqid('', true).'.'.$extension;

        $file->move($dir, $filename);

        return 'img/hero/'.$filename;
    }

    private function deleteStoredImageIfUploaded(?string $path): void
    {
        if ($path === null || $path === '' || ! str_starts_with($path, 'img/hero/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
