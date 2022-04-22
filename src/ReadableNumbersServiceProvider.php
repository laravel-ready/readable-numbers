<?php

namespace LaravelReady\ReadableNumbers;

use Illuminate\Support\Facades\Blade;

use LaravelReady\ReadableNumbers\Services\ReadableNumbers;
use LaravelReady\ReadableNumbers\Directives\NumberDirectives;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ReadableNumbersServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->bootPublishes();
    }

    public function register(): void
    {
        $this->registerDirectives();

        $this->app->singleton('readable-numbers', function () {
            return new ReadableNumbers();
        });
    }

    /**
     * Boot publishes
     */
    private function bootPublishes(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'readable-trans');
    }

    /**
     * Register blade directives
     */
    private function registerDirectives(): void
    {
        foreach ((new NumberDirectives())->directives as $name => $function) {
            Blade::directive($name, $function);
        }
    }
}
