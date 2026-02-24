<?php

namespace CreativityKills\FilamentArtisan;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentArtisanServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-artisan';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        //Publish Config
        $this->publishes([
            __DIR__.'/../config/filament-artisan.php' => config_path('filament-artisan.php'),
        ], 'filament-artisan-config');

        //Publish Views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-artisan'),
        ], 'filament-artisan-views');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-artisan'),
        ], 'filament-artisan-lang');

        FilamentAsset::register([
            Css::make('filament-artisan', __DIR__.'/../resources/css/filament-artisan.css')
                ->loadedOnRequest(),
        ], package: 'filament-artisan');
    }
}
