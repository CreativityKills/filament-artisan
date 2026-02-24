# Filament Artisan Command Runner

[![Latest Stable Version](https://poser.pugx.org/creativitykills/filament-artisan/version.svg)](https://packagist.org/packages/creativitykills/filament-artisan)
[![License](https://poser.pugx.org/creativitykills/filament-artisan/license.svg)](https://packagist.org/packages/creativitykills/filament-artisan)
[![Downloads](https://poser.pugx.org/creativitykills/filament-artisan/d/total.svg)](https://packagist.org/packages/creativitykills/filament-artisan)

Simple but yet powerful library for running some [artisan](https://laravel.com/docs/artisan) commands for Filament v4.

> Forked from [tomatophp/filament-artisan](https://github.com/tomatophp/filament-artisan) and maintained under the CreativityKills namespace.

## Requirements

- PHP ^8.2
- Filament ^4.0

## Installation

```bash
composer require creativitykills/filament-artisan
```

Then register the plugin in your panel provider:

```php
->plugin(\CreativityKills\FilamentArtisan\FilamentArtisanPlugin::make())
```

## Running commands

By default, you can access this page only in local environment. If you wish
you can change the `local` key in config.

Simply go to `http://your-domain.com/PANEL/artisan` and here we go!
Select a command from the list, fill in arguments and options/flags, and hit `run`.

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag="filament-artisan-config"
```

Key options in `config/filament-artisan.php`:

- `local` (bool) — restrict to local environment only
- `developer_gate` (bool) — enable developer password gate
- `commands` — array of command groups defining which commands are exposed
- `permissions` — per-command permission mapping (checked via Laravel Gate)
- `navigation` — controls nav group, icon, visibility
- `defer` — control deferred loading of table filters and column manager

## Publish Assets

Publish views:

```bash
php artisan vendor:publish --tag="filament-artisan-views"
```

Publish translations:

```bash
php artisan vendor:publish --tag="filament-artisan-lang"
```
