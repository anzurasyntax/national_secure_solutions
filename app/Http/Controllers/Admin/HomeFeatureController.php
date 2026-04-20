<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFeature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeFeatureController extends Controller
{
    public function edit(): View
    {
        $features = HomeFeature::query()->orderBy('position')->get();

        return view('admin.home-features.edit', compact('features'));
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [];
        for ($i = 1; $i <= 3; $i++) {
            $rules["title_{$i}"] = ['required', 'string', 'max:255'];
            $rules["description_{$i}"] = ['required', 'string', 'max:2000'];
        }

        $validated = $request->validate($rules);

        for ($i = 1; $i <= 3; $i++) {
            HomeFeature::query()->updateOrCreate(
                ['position' => $i],
                [
                    'title' => $validated["title_{$i}"],
                    'description' => $validated["description_{$i}"],
                ],
            );
        }

        return redirect()
            ->route('admin.home-features.edit')
            ->with('status', 'Feature cards updated.');
    }
}
