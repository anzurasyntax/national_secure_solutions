<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class WhyChooseUsController extends Controller
{
    public function edit(): View
    {
        $items = WhyChooseItem::query()->orderBy('position')->get();

        return view('admin.why-choose-us.edit', compact('items'));
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [];
        for ($i = 1; $i <= 3; $i++) {
            $rules["title_{$i}"] = ['required', 'string', 'max:255'];
            $rules["description_{$i}"] = ['required', 'string', 'max:5000'];
            $rules["icon_{$i}"] = ['nullable', 'image', 'max:2048'];
        }

        $validated = $request->validate($rules);

        for ($i = 1; $i <= 3; $i++) {
            $existing = WhyChooseItem::query()->where('position', $i)->first();

            $payload = [
                'title' => $validated["title_{$i}"],
                'description' => $validated["description_{$i}"],
            ];

            $fileKey = "icon_{$i}";
            if ($request->hasFile($fileKey)) {
                if ($existing !== null) {
                    $this->deleteStoredIcon($existing->icon_path);
                }
                $payload['icon_path'] = $this->storeIcon($request->file($fileKey));
            } elseif ($existing !== null) {
                $payload['icon_path'] = $existing->icon_path;
            } else {
                $payload['icon_path'] = 'img/chooseUs_icon1.png';
            }

            WhyChooseItem::query()->updateOrCreate(
                ['position' => $i],
                $payload,
            );
        }

        return redirect()
            ->route('admin.why-choose-us.edit')
            ->with('status', 'Why Choose Us section saved.');
    }

    private function storeIcon(\Illuminate\Http\UploadedFile $file): string
    {
        $dir = public_path('img/why-choose');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $basename ?? 'icon');
        $basename = trim($basename, '-') ?: 'icon';
        $filename = $basename.'-'.uniqid('', true).'.'.$extension;

        $file->move($dir, $filename);

        return 'img/why-choose/'.$filename;
    }

    private function deleteStoredIcon(?string $path): void
    {
        if ($path === null || $path === '' || ! str_starts_with($path, 'img/why-choose/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
