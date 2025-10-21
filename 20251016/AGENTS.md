# Repository Guidelines

## Project Structure & Module Organization
- `public/index.php` is the entry point; serve via the built-in PHP server with static assets in `public/assets`.
- Domain logic resides in `src`: `Router.php` wires `Controllers`, `Models` handle database access, and `views` render PHP templates.
- Runtime configuration is kept in `config/database.php`; update credentials locally and avoid committing secrets or temporary echoes.
- Tests live in `tests`, mirroring controller/model namespaces (see `HomeControllerTest.php`) so coverage stays aligned with app code.
- `_project-files` stores reference templates and schema docs that inform, but are not served by, the runtime application.

## Build, Test, and Development Commands
- `composer install` — install PHP dependencies (autoload + PHPUnit) before running anything else.
- `npm install` — install Prettier and the PHP plugin used for formatting checks inside CI.
- `php -S localhost:8000 -t public` — launch the local dev server; ensure MySQL is running and credentials match `config/database.php`.
- `./vendor/bin/phpunit` — execute the PHPUnit suite; add `--testdox` when sharing human-readable results.
- `npx prettier --check "src/**/*.php"` (or `--write`) — enforce consistent formatting across controllers, models, and views.

## Coding Style & Naming Conventions
- Follow PSR-12: 4-space indentation, brace on the next line, declare strict types when practical, and keep files ASCII.
- Namespaces map PSR-4 autoloading (`Shogomorisawa\Project\…`); classes use StudlyCaps, methods camelCase, and multi-word view filenames stay snake_case.
- Keep controllers thin; push data validation to models and sanitize raw input (see `mysqli_real_escape_string` usage in `UserModel`).
- Prefer dependency injection (pass `$connection` explicitly) over globals and avoid emitting output from configuration bootstraps.

## Testing Guidelines
- Add PHPUnit cases under `tests`, named `[Subject]Test.php` with methods beginning `test`; import namespaces explicitly rather than relying on globals.
- Buffer rendered views in tests (`ob_start()` pattern) when asserting output strings like the Japanese copy in `HomeControllerTest`.
- Run tests before commits; for DB-dependent logic, stub mysqli or use an isolated test database to prevent data leakage.

## Commit & Pull Request Guidelines
- Follow conventional commits (`feat:`, `fix:`, `chore:`) as in `9349fff feat: ユーザー登録機能を実装`; short subjects with optional Japanese or English descriptions are fine.
- Squash WIP commits; document the "why" in PR descriptions, link issues/tasks, and outline manual verification steps.
- Attach screenshots or GIFs for view updates in `src/views` and call out schema impacts whenever MySQL tables change.
- Confirm formatting, tests, and the dev server all succeed locally before requesting review.
