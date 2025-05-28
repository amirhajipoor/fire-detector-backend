<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        ini_set('memory_limit', '-1');

        $this->configureDates();
        $this->configLivewire();
        $this->configResources();
        // $this->configSecurity();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function configSecurity(): void
    {
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configResources(): void
    {
        JsonResource::withoutWrapping();
    }

    private function configLivewire(): void
    {
        $checkValidSignature = (
            $this->app->isProduction() && str_contains(URL::current(), 'livewire/upload-file')
        );

        Request::macro('hasValidSignature', function ($absolute = true) use ($checkValidSignature) {
            if ($checkValidSignature) {
                return true;
            }

            return URL::hasValidSignature($this, $absolute);
        });

        Request::macro('hasValidRelativeSignature', function () use ($checkValidSignature) {
            if ($checkValidSignature) {
                return true;
            }

            return URL::hasValidSignature($this, $absolute = false);
        });

        Request::macro(
            'hasValidSignatureWhileIgnoring',
            function ($ignoreQuery = [], $absolute = true) use ($checkValidSignature) {
                if ($checkValidSignature) {
                    return true;
                }

                return URL::hasValidSignature($this, $absolute, $ignoreQuery);
            }
        );
    }
}
