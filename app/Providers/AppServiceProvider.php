<?php

namespace App\Providers;

use App\Contracts\PaymentGatewayContract;
use App\Models\SiteSetting;
use App\Services\Payment\FakePaymentGateway;
use App\Services\Payment\StripeCoursePaymentGateway;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayContract::class, function (): PaymentGatewayContract {
            $driver = config('courses.payment_driver', 'stripe');

            if ($driver === 'fake' && app()->environment('production')) {
                throw new \RuntimeException(
                    'COURSE_PAYMENT_DRIVER=fake is not allowed when APP_ENV=production. Use stripe with valid Stripe credentials.'
                );
            }

            return match ($driver) {
                'fake' => new FakePaymentGateway,
                default => new StripeCoursePaymentGateway,
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $siteSettingComposer = function ($view): void {
            if (! Schema::hasTable('site_settings')) {
                $view->with('siteSetting', new SiteSetting(SiteSetting::defaultAttributes()));

                return;
            }

            $view->with('siteSetting', SiteSetting::current());
        };

        View::composer(
            ['layouts.app', 'layouts.admin', 'auth.login', 'admin.auth.login'],
            $siteSettingComposer
        );
    }
}
