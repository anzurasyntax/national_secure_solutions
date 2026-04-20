<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurValue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OurValueController extends Controller
{
    public function index(): View
    {
        $values = OurValue::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.our-values.index', compact('values'));
    }

    public function create(): View
    {
        return view('admin.our-values.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['required', 'string', 'max:255'],
            'line1' => ['required', 'string', 'max:255'],
            'line2' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        if (! $request->hasFile('image') && ! filled($request->input('image_url'))) {
            throw ValidationException::withMessages([
                'image' => ['Upload an image or paste an image URL.'],
            ]);
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request->file('image'));
        } else {
            $validated['image_path'] = trim((string) $request->input('image_url'));
        }

        unset($validated['image'], $validated['image_url']);

        $validated['sort_order'] = $validated['sort_order'] ?? (((int) (OurValue::query()->max('sort_order') ?? 0)) + 1);

        OurValue::query()->create($validated);

        return redirect()->route('admin.our-values.index')->with('status', 'Value card created.');
    }

    public function edit(OurValue $our_value): View
    {
        return view('admin.our-values.edit', ['value' => $our_value]);
    }

    public function update(Request $request, OurValue $our_value): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['required', 'string', 'max:255'],
            'line1' => ['required', 'string', 'max:255'],
            'line2' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($our_value->image_path);
            $validated['image_path'] = $this->storeImage($request->file('image'));
        } elseif (trim((string) $request->input('image_url')) !== '') {
            $this->deleteStoredImage($our_value->image_path);
            $validated['image_path'] = trim((string) $request->input('image_url'));
        }

        unset($validated['image'], $validated['image_url']);

        $our_value->update($validated);

        return redirect()->route('admin.our-values.index')->with('status', 'Value card updated.');
    }

    public function destroy(OurValue $our_value): RedirectResponse
    {
        $this->deleteStoredImage($our_value->image_path);
        $our_value->delete();

        return redirect()->route('admin.our-values.index')->with('status', 'Value card deleted.');
    }

    private function storeImage(\Illuminate\Http\UploadedFile $file): string
    {
        $dir = public_path('img/our-values');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $basename ?? 'value');
        $basename = trim($basename, '-') ?: 'value';
        $filename = $basename.'-'.uniqid('', true).'.'.$extension;

        $file->move($dir, $filename);

        return 'img/our-values/'.$filename;
    }

    private function deleteStoredImage(?string $path): void
    {
        if ($path === null || $path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        if (! str_starts_with($path, 'img/our-values/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
