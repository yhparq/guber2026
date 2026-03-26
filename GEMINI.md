# GUBER 2026 - Management System

## Project Overview
GUBER 2026 is a comprehensive management system for the **XI Convención Nacional de Contabilidad Gubernamental y Gestión Pública**. The application handles participant registrations (individual and corporate), course management, and provides a virtual classroom (Aula Virtual) for attendees.

### Tech Stack
- **Backend:** Laravel 12.x
- **Frontend:** Vue 3 (Composition API) with TypeScript
- **Communication:** Inertia.js (Modern monolith approach)
- **Styling:** Tailwind CSS 4.x
- **Authentication:** Laravel Fortify
- **Database:** MySQL / SQLite
- **Icons:** Lucide Vue Next

## Architecture & Key Components
- **Public Registration:** Located at `/inscripcion-individual` and `/inscripcion-corporativa`. These routes use `ParticipantController` and `CorporateParticipantController` respectively.
- **Admin Panel:** A secure area (middleware `auth`, `verified`) to manage participants, courses, and photos.
- **Aula Virtual:** A dedicated space for participants to access live sessions and materials, accessible via `/aula-virtual`.
- **DNI Integration:** Automatic person data lookup via `DniController` which interfaces with `apiperu.dev`.

## Building and Running

### Prerequisites
- PHP 8.2+
- Node.js & NPM
- Composer

### Key Commands
- **Setup Project:** `composer run setup` (Installs dependencies, generates key, runs migrations, and builds assets)
- **Development Mode:** `npm run dev` (Runs Vite and the Laravel server concurrently)
- **Production Build:** `npm run build`
- **Linting:** `composer run lint` (PHP Pint) or `npm run lint` (ESLint)
- **Testing:** `php artisan test`

## Development Conventions

### Coding Style
- **Backend:** Follows standard Laravel PSR-12 conventions. Uses `Laravel Pint` for automated formatting.
- **Frontend:** Vue 3 script setup with TypeScript. Uses `Prettier` and `ESLint` for consistency.
- **CSS:** Utility-first approach using Tailwind CSS. Custom variables (like `--primary`) are defined in `resources/css/app.css`.

### Feature Workflow
- **Surgical Updates:** When modifying features like registration, ensure both individual and corporate logic are considered (though they use separate tables `participants` and `corporate_participants`).
- **Email Notifications:** Handled by `App\Mail\ParticipantActivated`. Always wrap `Mail::send` in `try-catch` blocks to prevent crashes on SMTP failures.
- **API Lookups:** Use the established `api.dni` route for fetching participant data to ensure consistent data entry.

### Project Progress
Refer to `AVANCES_PROYECTO.md` for a detailed log of implemented features and pending tasks.
