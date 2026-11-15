# Package gaps

The mill uses the published `imrandevbd` packages. Where a package is missing or does not cover a mill rule, the app keeps a thin adapter and does not replace the package.

| Package | What is missing | What the app does |
|---|---|---|
| `imrandevbd/adhikar` | Not published (Packagist returns 404). | `app/Support/Adhikar` provides `ImranDev\Adhikar\Adhikar` and a Permission model so Filament master’s permission hook can see it. Roles are stored in `roles`, `permissions`, `role_user`. |
| `imrandevbd/tarikh` | Composer registers `Tarikh\Laravel\TarikhServiceProvider`, which is not in the package. `Tarikh\Tarikh` has no Bangla calendar. | The package is not auto-discovered. `App\Support\BanglaDate` implements the Bangladesh revised calendar (Boishakh starts 14 April). |
| `imrandevbd/laravel-filament-master` | Imports `Filament\Commands\Concerns\CanManipulateFiles`, which Filament 3 moved. | `compat/filament_master_trait.php` re-exports the Filament 3 trait. Resources extend `MillResource`, which hides cost fields unless the role may see them. |
| `imrandevbd/laravel-admin-panel` | Its own UI defaults to `/admin`. | Prefix is `/shell`. The ERP is the Filament panel. |
| `imrandevbd/laravel-unicode-pdf` | dompdf, mpdf and browsershot are suggested, not required. The native engine downloads fonts on first use. | Documents call `UnicodePdf::view()`. HTML for the same documents is rendered even if the font download is unavailable. |
| `imrandevbd/laravel-ai-hub`, `laravel-ai-ocr`, `laravel-ai-catalog` | No mill prompts are executed automatically, and this environment has no provider key. | Prompt templates have a table (`ai_prompt_templates`). OCR and catalog entry stay human-confirmed. Destructive posting is never done by a model. |
| `imrandevbd/laravel-attendance-hub` | No physical ZKTeco device is attached. | The hub’s `attendance_devices` table is used by the offline-device issue rule. Demo attendance rows are written by the mill seeder. |
| `imrandevbd/drutogoti` | Left disabled (`DRUTOGOTI_ENABLED` unset) until its own migrations are reviewed on the production database. | Dashboards query the indexed mill tables directly. |
| Turnstile | No site key is shipped. | Forms work with a honeypot and rate limit. Set `TURNSTILE_SECRET` to require the captcha. |
| PHP GD | Not installed on this machine. | Public images are not converted to WebP here. Install `php-gd` on the VPS before catalogue photography. |
