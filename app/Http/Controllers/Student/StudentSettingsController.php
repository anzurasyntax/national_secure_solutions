<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\UpdateStudentPasswordRequest;
use App\Http\Requests\Student\UpdateStudentProfileRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSettingsController extends Controller
{
    public function edit(): View
    {
        $tab = request()->query('tab', 'profile');
        if (! in_array($tab, ['profile', 'password'], true)) {
            $tab = 'profile';
        }

        return view('student.settings.edit', [
            'activeNav' => 'settings',
            'tab' => $tab,
            'user' => Auth::user(),
            'timezones' => self::timezoneChoices(),
        ]);
    }

    public function updateProfile(UpdateStudentProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = collect($request->validated())->except(['avatar', 'cover'])->all();
        $data['name'] = trim($data['first_name'].' '.$data['last_name']);

        if ($request->hasFile('avatar')) {
            self::deleteStudentImage($user->avatar_path);
            $data['avatar_path'] = self::storeImage($request->file('avatar'), 'img/students/avatars');
        }

        if ($request->hasFile('cover')) {
            self::deleteStudentImage($user->cover_path);
            $data['cover_path'] = self::storeImage($request->file('cover'), 'img/students/covers');
        }

        $user->update($data);

        return redirect()->route('student.settings', ['tab' => 'profile'])->with('status', 'Profile updated.');
    }

    public function updatePassword(UpdateStudentPasswordRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->validated('password')),
        ]);

        return redirect()->route('student.settings', ['tab' => 'password'])->with('status', 'Password updated.');
    }

    /**
     * @return list<string>
     */
    private static function timezoneChoices(): array
    {
        $preferred = ['UTC', 'America/Toronto', 'America/New_York', 'America/Chicago', 'America/Denver', 'America/Los_Angeles', 'America/Phoenix', 'Europe/London', 'Asia/Dubai'];

        return array_values(array_unique(array_merge($preferred, array_slice(timezone_identifiers_list(), 0, 400))));
    }

    private static function storeImage(UploadedFile $file, string $relativeDir): string
    {
        $dir = public_path($relativeDir);
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.uniqid('', true).'.'.$extension;
        $file->move($dir, $filename);

        return $relativeDir.'/'.$filename;
    }

    private static function deleteStudentImage(?string $path): void
    {
        if ($path === null || $path === '' || ! str_starts_with($path, 'img/students/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
