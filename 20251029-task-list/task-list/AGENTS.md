# Repository Guidelines

## Project Structure & Module Organization
The Laravel application keeps domain logic in `app/`; controllers live under `app/Http/Controllers`, jobs and events should remain close to their feature. Routes are defined in `routes/web.php` for the UI task list and `routes/api.php` for API hooks. Front-end assets live in `resources/js` and `resources/css`, Blade templates in `resources/views`, while database migrations and seeders sit in `database/migrations` and `database/seeders`. Static entry points are served from `public/`, and persistent storage outputs stay in `storage/`.

## Build, Test, and Development Commands
Run `composer setup` once to install dependencies, scaffold `.env`, generate the key, run migrations, and build the front end. During local work, `composer dev` starts the Sail-powered PHP server, queue listener, log tailing, and Vite watcher concurrently. Use `npm run build` for production asset compilation, and `php artisan migrate --force` before deploying schema changes.

## Coding Style & Naming Conventions
Adhere to PSR-12; keep PHP indented with four spaces and avoid trailing whitespace. Format PHP using `./vendor/bin/pint` (configured via `laravel/pint`) and rely on Vite/Tailwind conventions for CSS. Name classes in `PascalCase`, config keys in `snake_case`, Blade files with `kebab-case.blade.php`, and Vue/JS modules in `camelCase`. Keep feature folders self-contained and avoid placing business logic in controllers—prefer service classes within `app/`.

## Testing Guidelines
Feature tests belong in `tests/Feature` and should exercise task creation, updates, and authorization. Unit tests live in `tests/Unit` and cover isolated services or helpers. Execute `composer test` (which clears config cache and calls `php artisan test`) before opening a pull request; include at least one new assertion for every bug fix or feature. Stub external services with Laravel fakes and seed test data via factories rather than manual inserts.

## Commit & Pull Request Guidelines
Follow the existing pattern `20251029-task-list/<type>: short imperative message` (e.g., `20251029-task-list/feat: add task filters`). Group related changes into single commits and ensure they pass tests locally. PRs should describe intent, list test coverage, reference related issues, and attach screenshots or screencasts for UI changes. Request review once CI is green and migrations are reversible.

## Environment & Security Tips
Copy `.env.example` to `.env` and configure database credentials before running Sail; keep secrets out of version control. Start the Docker stack with `./vendor/bin/sail up` when not using the Composer shortcut. Run `php artisan key:generate` whenever the app key is missing, and rotate credentials immediately if committed accidentally.
