# Deployment

One VPS is enough: FastPanel or nginx, PHP-FPM 8.3+, MySQL 8, Redis, Horizon, and the scheduler.

## Server

1. Point the site root at `public/`.
2. PHP extensions: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `mbstring`, `pdo_mysql`, `redis`, `tokenizer`, `xml`, `gd`.
3. Copy `.env.example` to `.env`. Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, `DB_*` for MySQL 8, `CACHE_STORE=redis`, `QUEUE_CONNECTION=redis`, `SESSION_DRIVER=database`. Leave `APP_TIMEZONE` unset so it stays UTC.
4. `composer install --no-dev --optimize-autoloader`
5. `php artisan key:generate`
6. `php artisan migrate --force`
7. `php artisan db:seed --force` once. The owner is `owner@mill.test` / `password`. Change that password before the site is public.
8. `npm ci && npm run build`
9. `php artisan storage:link`
10. `php artisan config:cache && php artisan route:cache && php artisan view:cache`

## Processes

- PHP-FPM for the web.
- Queue: `php artisan horizon` under supervisor, restarting on failure.
- Scheduler: `* * * * * php /path/artisan schedule:run` in cron. The issue evaluation runs at 06:00 Asia/Dhaka.
- Optional: `ADMIN_IP_ALLOWLIST` is a comma-separated list of exact addresses, for example `203.0.113.10,203.0.113.11`. Leave it empty to allow every address.

## Backup

Nightly:

```bash
mysqldump --single-transaction --routines woven_mill | gzip > /var/backups/mill-$(date +%F).sql.gz
tar -czf /var/backups/mill-storage-$(date +%F).tar.gz storage/app
```

Keep 14 daily copies and one copy off the VPS.

## Restore

1. Maintenance mode: `php artisan down`
2. Empty the target database and load the dump: `gunzip -c mill-YYYY-MM-DD.sql.gz | mysql woven_mill`
3. Replace `storage/app` from the tarball. Keep `storage/framework` and `storage/logs` owned by the PHP user.
4. `php artisan migrate --force` in case the code is newer than the dump.
5. `php artisan horizon:terminate` so supervisor starts a fresh worker.
6. `php artisan up`

Do not restore `.env` from a backup that belongs to another host. The application key must match the database you restored, or encrypted two-factor secrets will not open.
