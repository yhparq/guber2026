# Agent Guidelines for Guber 2026

Welcome! You are operating in a Laravel 12 + Vue 3 (Inertia.js) + TypeScript application using Tailwind CSS v4.
Follow these instructions strictly to ensure consistency and quality.

## 1. Build / Lint / Test Commands

### 🧪 Testing (Pest PHP)

- **Run full test suite (lint + tests):** `composer test`
- **Run all tests:** `./vendor/bin/pest` or `php artisan test`
- **🔥 RUN A SINGLE TEST (CRITICAL FOR AGENTS):**
    - By Method/Name: `./vendor/bin/pest --filter="it can create a user"`
    - By File: `./vendor/bin/pest tests/Feature/UserTest.php`
    - When debugging a specific issue, ALWAYS run a single test rather than the full suite.
- **Watch Mode:** `./vendor/bin/pest --watch`

### 🧹 Linting & Formatting

- **PHP Lint/Format (Pint):** `composer lint` or `./vendor/bin/pint`
- **PHP Test Lint:** `composer test:lint`
- **JS/TS Format Check:** `npm run format:check`
- **JS/TS Format Fix (Prettier):** `npm run format`
- **JS/TS Lint (ESLint):** `npm run lint` (runs with `--fix`)

### 🏗️ Build & Dev Server

- **Install Dependencies:** `npm install` && `composer install`
- **Start Dev Environment (Vite + Laravel):** `composer dev` (runs PHP server, queue, Vite concurrently)
- **Start Dev Environment with SSR:** `composer dev:ssr`
- **Build for Production:** `npm run build`
- **Build for Production with SSR:** `npm run build:ssr`

## 2. Code Style & Conventions

### 🐘 PHP (Laravel)

- **Formatting:** PSR-12 standard enforced by Laravel Pint. Indentation is 4 spaces.
- **Types:** Strictly use PHP 8.2+ typed properties, arguments, and return types. Avoid `mixed` where possible.
- **Naming Conventions:**
    - Classes & Interfaces: `StudlyCase` (e.g., `CourseController`, `PaymentGatewayInterface`)
    - Methods & Variables: `camelCase` (e.g., `$validatedData`, `getUser()`)
    - Database Tables: `snake_case` plural (e.g., `user_profiles`)
    - Database Columns: `snake_case` (e.g., `created_at`, `is_active`)
    - Constants: `UPPER_SNAKE_CASE` (e.g., `MAX_RETRY_COUNT`)
- **Imports:** Fully qualified class names. Order: Laravel > Custom > Third-party.
- **Error Handling:** Use `try/catch` for external services. Throw custom exceptions where applicable. Return meaningful error messages.
- **Architecture:**
    - Keep controllers thin. Extract complex business logic into Services or Actions.
    - Use Form Requests (`app/Http/Requests`) for all incoming data validation instead of inline `$request->validate()`.
- **API Responses:** Return JSON standard responses `response()->json([...])` for API routes.
- **Models:** Use PHPDoc `@property` annotations for Eloquent relationships to assist with static analysis.

### ⚡ Vue 3 & TypeScript

- **Syntax:** Always use `<script setup lang="ts">` for Vue components.
- **Imports:** Use path aliases (`@/components/...`, `@/pages/...`). Import order: builtin > external > internal > parent > sibling > index (enforced by ESLint).
- **Types:** Define specific TypeScript interfaces/types for all component props and state. Place shared types in `resources/js/types/`.
- **Props & Emits:**
    - Use `defineProps<{ ... }>()` with generic types. Use `withDefaults` for optional props.
    - Use `defineEmits<{ ... }>()` for full type inference of emitted events.
- **Naming:** Vue components must be PascalCase and multi-word (e.g., `UserProfile.vue`, `CourseCard.vue`).
- **Styling:** Use Tailwind CSS v4 utility classes. Avoid `<style scoped>` unless absolutely necessary.

### ⚙️ Prettier Configuration Reference

```json
{
    "semi": true,
    "singleQuote": true,
    "tabWidth": 4,
    "printWidth": 80,
    "plugins": [
        "prettier-plugin-organize-imports",
        "prettier-plugin-tailwindcss"
    ]
}
```

## 3. File Organization

- **Controllers:** `app/Http/Controllers/`
- **Models:** `app/Models/`
- **Migrations:** `database/migrations/`
- **Factories:** `database/factories/`
- **Seeders:** `database/seeders/`
- **Form Requests:** `app/Http/Requests/`
- **Middleware:** `app/Http/Middleware/`
- **Frontend Components:** `resources/js/components/ui/` (shadcn-vue style)
- **Frontend Pages:** `resources/js/pages/` (Inertia pages)
- **Types:** `resources/js/types/`
- **Composables:** `resources/js/composables/`
- **Layouts:** `resources/js/layouts/`

## 4. Testing Guidelines (Pest)

- **Feature Tests:** Located in `tests/Feature/`
- **Unit Tests:** Located in `tests/Unit/`
- **Naming Convention:** Use the `test()` or `it()` function. Describe behavior, not implementation details.
- **Database:** Tests use the `RefreshDatabase` trait automatically (configured in `tests/Pest.php`).
- **Factories:** Use factories for test data generation (e.g., `User::factory()->create()`).
- **Assertions:** Use Pest's Expect fluent API (`expect($value)->toBe(...)`).

### Test Examples

```php
test('user can be created via factory', function () {
    $user = User::factory()->create();

    expect($user->name)->toBeString();
    expect($user->email)->toContain('@');
});

it('can fetch course details', function () {
    $course = Course::factory()->create();

    $response = $this->getJson(route('api.courses.show', $course));

    $response->assertStatus(200)
             ->assertJsonPath('data.id', $course->id);
});
```

## 5. Git & Commits

- **Branch Naming:** `feature/description`, `fix/description`, `chore/description`, `refactor/description`
- **Commits:** Follow conventional commits (`feat:`, `fix:`, `docs:`, `style:`, `refactor:`, `test:`, `chore:`).
- **Prohibited:** NEVER commit `.env` or `.env.*` (except `.env.example`), `vendor/`, or `node_modules/`.

## 6. General Best Practices

1. **Verify Before Committing:** Always run `composer test` and `npm run lint` before creating commits.
2. **Database Modifications:** Use migrations for all schema modifications (`php artisan make:migration`). Do not modify the DB manually.
3. **Database Primary Keys:** Use UUIDs for primary keys when required by the architecture (check existing models for the pattern).
4. **Foreign Keys:** Use `foreignId()->constrained()` for clean relationship definitions in migrations.
5. **Types Safety:** Ensure `strict: true` is adhered to in `tsconfig.json`.
6. **Null Checks:** Use Laravel's `optional()` helper or PHP 8's nullsafe operator `?->` when accessing potentially null relationships.
7. **Routing:** Always use the `route()` helper for named routes in both PHP code and frontend templates.

---

_Note: Read these instructions carefully before proposing or applying code changes to ensure alignment with project standards. By adhering to these guidelines, we maintain a clean, testable, and robust codebase._
