<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeStat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeStatController extends Controller
{
    public function edit(): View
    {
        $stats = HomeStat::query()->orderBy('position')->get();

        return view('admin.home-stats.edit', compact('stats'));
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [];
        for ($i = 1; $i <= 4; $i++) {
            $rules["heading_{$i}"] = ['required', 'string', 'max:255'];
            $rules["value_{$i}"] = ['required', 'integer', 'min:0', 'max:999999999'];
            $rules["suffix_{$i}"] = ['nullable', 'string', 'max:10'];
        }

        $validated = $request->validate($rules);

        for ($i = 1; $i <= 4; $i++) {
            HomeStat::query()->updateOrCreate(
                ['position' => $i],
                [
                    'heading' => $validated["heading_{$i}"],
                    'value' => (int) $validated["value_{$i}"],
                    'suffix' => trim((string) ($validated["suffix_{$i}"] ?? '')),
                ],
            );
        }

        return redirect()
            ->route('admin.home-stats.edit')
            ->with('status', 'Home stats saved.');
    }
}
