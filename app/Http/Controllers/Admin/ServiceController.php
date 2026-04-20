<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:5000'],
            'body' => ['nullable', 'string', 'max:50000'],
            'image' => ['required', 'image', 'max:5120'],
            'icon' => ['required', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        $validated['image_path'] = $this->storeServiceImage($request->file('image'), false);
        $validated['icon_path'] = $this->storeServiceImage($request->file('icon'), true);
        unset($validated['image'], $validated['icon']);

        $validated['sort_order'] = $validated['sort_order'] ?? (((int) (Service::query()->max('sort_order') ?? 0)) + 1);

        Service::query()->create($validated);

        return redirect()->route('admin.services.index')->with('status', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:5000'],
            'body' => ['nullable', 'string', 'max:50000'],
            'image' => ['nullable', 'image', 'max:5120'],
            'icon' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        if ($request->hasFile('image')) {
            $this->deleteServiceStoredFile($service->image_path);
            $validated['image_path'] = $this->storeServiceImage($request->file('image'), false);
        }
        if ($request->hasFile('icon')) {
            $this->deleteServiceStoredFile($service->icon_path);
            $validated['icon_path'] = $this->storeServiceImage($request->file('icon'), true);
        }

        unset($validated['image'], $validated['icon']);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('status', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->deleteServiceStoredFile($service->image_path);
        $this->deleteServiceStoredFile($service->icon_path);
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Service deleted.');
    }

    private function storeServiceImage(\Illuminate\Http\UploadedFile $file, bool $icon): string
    {
        $sub = $icon ? 'icons' : 'covers';
        $dir = public_path('img/services/'.$sub);
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $basename ?? 'image');
        $basename = trim($basename, '-') ?: 'image';
        $filename = $basename.'-'.uniqid('', true).'.'.$extension;

        $file->move($dir, $filename);

        return 'img/services/'.$sub.'/'.$filename;
    }

    private function deleteServiceStoredFile(?string $path): void
    {
        if ($path === null || $path === '') {
            return;
        }

        if (! str_starts_with($path, 'img/services/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
