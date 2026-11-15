# Decisions

These are the choices made while building the mill, so the next change does not reopen them.

- Laravel 12 with Filament 3.3. The prompt asked for Filament 3, and `laravel-filament-master` allows Filament 3 or 4.
- Local development and tests use SQLite. This machine cannot authenticate to MySQL as the `dev` user. Production is MySQL 8, described in `deployment.md`.
- Application timezone stays UTC. Screens and the morning job use Asia/Dhaka. Bangla dates are calculated in `App\Support\BanglaDate` because the installed Tarikh package has no Bangla calendar.
- Adhikar is not on Packagist. Roles and permissions live in the app, under the `ImranDev\Adhikar` namespace the Filament master package already looks for. Spatie Permission is not installed. Activity is recorded with `spatie/laravel-activitylog` 5, whose trait and log options live in the namespaces used by that release.
- The admin-panel package is mounted at `/shell` (`ADMIN_PANEL_PREFIX`) so Filament can keep `/admin`.
- `imrandevbd/tarikh` is excluded from package discovery. Its composer file points at a Laravel provider that is not in the package.
- Filament master’s file trait is shimmed from `compat/filament_master_trait.php` onto the Filament 3 class name the package still imports.
- Money and quantities use Brick\Math. The only writer of journal lines is `PostingService`. A journal that does not balance is refused, and a locked fiscal period refuses the date.
- Yarn issued to a job card cannot mix a second lot of the same yarn unless `mix_approved` is set.
- Grey cloth is graded on points per 100 square yards: A to 20, B to 28, C to 40, then reject. The 10-point system uses 20 / 30 / 40. Thresholds sit in `config/mill.php`.
- Total ends are EPI times cloth width in inches, plus selvedge ends. The reference cloth is 133 EPI at 160 cm, which is 8,378 ends.
- Public forms use a honeypot and a rate limit. Cloudflare Turnstile runs only when `TURNSTILE_SECRET` is set.
- Pest 4 is paired with PHPUnit 12 because Pest 3 cannot install against the PHPUnit version this skeleton locked.
