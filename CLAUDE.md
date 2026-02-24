# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Package Overview

This is **filament-artisan**, a Filament panel plugin that provides a GUI for executing Laravel Artisan commands. It's a fork of `tomatophp/filament-artisan` maintained locally at `CreativityKills/filament-artisan`.

Currently targets **Filament v3** and **PHP ^8.1|^8.2**.

## Architecture

**Entry points:**
- `FilamentArtisanServiceProvider` — Laravel service provider; registers config, views, translations. Auto-discovered via composer.json `extra.laravel.providers`.
- `FilamentArtisanPlugin` — Filament `Plugin` contract implementation; registers the Artisan page and developer gate plugin into the panel.

**Core classes:**
- `Pages/Artisan` — The single Filament Page that renders the command table and handles command execution. Uses `InteractsWithTable` and `InteractsWithActions` traits.
- `Models/Command` — In-memory Eloquent model using the **Sushi** trait. Dynamically discovers available Artisan commands from config and populates them as rows (no database).

**Flow:** Config defines command groups → `Command::getRows()` resolves them against the Artisan kernel → displayed as a searchable table on the `Artisan` page → user fills arguments/options in a modal → `runCommand()` calls `Artisan::call()` and displays output.

## Key Dependencies

- `filament/filament` ^3.0.0 — Core framework
- `calebporzio/sushi` — Powers the in-memory Command model
- `tomatophp/filament-developer-gate` — Optional password gate middleware
- `tomatophp/console-helpers` — Console utilities

## Publishing Assets

```bash
php artisan vendor:publish --tag="filament-artisan-config"
php artisan vendor:publish --tag="filament-artisan-views"
php artisan vendor:publish --tag="filament-artisan-lang"
```

## Configuration

All in `config/filament-artisan.php`. Key options:
- `local` (bool) — Restrict to local env only
- `developer_gate` (bool) — Enable developer password gate
- `commands` — Array of command groups defining which commands are exposed
- `permissions` — Per-command permission mapping (checked via Laravel Gate)
- `navigation` — Controls nav group, icon, visibility

## Security Layers

Multiple layers protect command execution: auth middleware → email verification → optional DeveloperGateMiddleware → per-command permissions via Gate → optional local-env-only restriction.

## Testing

Test directories exist at `tests/Feature/` and `tests/Unit/` but are currently empty. No test runner is configured in composer scripts.

## Translations

Supported locales: `en`, `ar`. Translation files are in `resources/lang/{locale}/messages.php`.
