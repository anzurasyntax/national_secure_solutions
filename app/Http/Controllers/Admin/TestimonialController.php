<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:50000'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'avatar' => ['nullable', 'image', 'max:5120'],
            'avatar_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        if (! $request->hasFile('avatar') && ! filled($request->input('avatar_url'))) {
            throw ValidationException::withMessages([
                'avatar' => ['Upload an avatar image or paste an image URL.'],
            ]);
        }

        if ($request->hasFile('avatar')) {
            $validated['avatar_path'] = $this->storeAvatar($request->file('avatar'));
        } else {
            $validated['avatar_path'] = trim((string) $request->input('avatar_url'));
        }

        unset($validated['avatar'], $validated['avatar_url']);

        $validated['sort_order'] = $validated['sort_order'] ?? (((int) (Testimonial::query()->max('sort_order') ?? 0)) + 1);

        Testimonial::query()->create($validated);

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:50000'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'avatar' => ['nullable', 'image', 'max:5120'],
            'avatar_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        if ($request->hasFile('avatar')) {
            $this->deleteStoredAvatar($testimonial->avatar_path);
            $validated['avatar_path'] = $this->storeAvatar($request->file('avatar'));
        } elseif (trim((string) $request->input('avatar_url')) !== '') {
            $this->deleteStoredAvatar($testimonial->avatar_path);
            $validated['avatar_path'] = trim((string) $request->input('avatar_url'));
        }

        unset($validated['avatar'], $validated['avatar_url']);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $this->deleteStoredAvatar($testimonial->avatar_path);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial deleted.');
    }

    private function storeAvatar(\Illuminate\Http\UploadedFile $file): string
    {
        $dir = public_path('img/testimonials');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $basename ?? 'avatar');
        $basename = trim($basename, '-') ?: 'avatar';
        $filename = $basename.'-'.uniqid('', true).'.'.$extension;

        $file->move($dir, $filename);

        return 'img/testimonials/'.$filename;
    }

    private function deleteStoredAvatar(?string $path): void
    {
        if ($path === null || $path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        if (! str_starts_with($path, 'img/testimonials/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
