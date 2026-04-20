<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\HomeFeatureController;
use App\Http\Controllers\Admin\HomeCtaController;
use App\Http\Controllers\Admin\HomeStatController;
use App\Http\Controllers\Admin\OurValueController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Models\AboutPage;
use App\Models\HeroSlide;
use App\Models\HomeFeature;
use App\Models\HomeCta;
use App\Models\HomeStat;
use App\Models\OurValue;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\WhyChooseItem;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'heroSlides' => HeroSlide::query()->orderBy('sort_order')->orderBy('id')->get(),
        'homeFeatures' => HomeFeature::query()->orderBy('position')->get(),
        'aboutPage' => AboutPage::query()->first() ?? new AboutPage(AboutPage::defaultAttributes()),
        'homeStats' => HomeStat::query()->orderBy('position')->get(),
        'homeServices' => Service::query()->orderByDesc('created_at')->orderByDesc('id')->limit(3)->get(),
        'whyChooseItems' => WhyChooseItem::query()->orderBy('position')->orderBy('id')->get(),
        'ourValues' => OurValue::query()->orderBy('sort_order')->orderBy('id')->get(),
        'homeCta' => HomeCta::content(),
        'testimonials' => Testimonial::query()->orderBy('sort_order')->orderBy('id')->get(),
    ]);
})->name('home');

Route::get('/about', function () {
    $aboutPage = AboutPage::query()->first();

    return view('about', [
        'aboutPage' => $aboutPage ?? new AboutPage(AboutPage::defaultAttributes()),
    ]);
})->name('about');
Route::get('/services', function () {
    return view('services', [
        'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
    ]);
})->name('services');
Route::get('/training', function () {
    return view('training');
})->name('training');
Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);

    Route::get('/home-features/edit', [HomeFeatureController::class, 'edit'])->name('home-features.edit');
    Route::put('/home-features', [HomeFeatureController::class, 'update'])->name('home-features.update');

    Route::get('/home-stats/edit', [HomeStatController::class, 'edit'])->name('home-stats.edit');
    Route::put('/home-stats', [HomeStatController::class, 'update'])->name('home-stats.update');

    Route::get('/home-cta/edit', [HomeCtaController::class, 'edit'])->name('home-cta.edit');
    Route::put('/home-cta', [HomeCtaController::class, 'update'])->name('home-cta.update');

    Route::get('/about-page/edit', [AboutPageController::class, 'edit'])->name('about-page.edit');
    Route::put('/about-page', [AboutPageController::class, 'update'])->name('about-page.update');

    Route::resource('services', ServiceController::class)->except(['show']);

    Route::resource('our-values', OurValueController::class)
        ->parameters(['our-values' => 'our_value'])
        ->except(['show']);

    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    Route::get('/why-choose-us/edit', [WhyChooseUsController::class, 'edit'])->name('why-choose-us.edit');
    Route::put('/why-choose-us', [WhyChooseUsController::class, 'update'])->name('why-choose-us.update');
});
