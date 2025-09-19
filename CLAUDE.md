# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel-based e-learning platform called "Indeca Academic" built with:
- **Backend**: Laravel 12.x with PHP 8.2+
- **Frontend**: Livewire 3.6+ with Tailwind CSS 3.4
- **Authentication**: Laravel Jetstream with Fortify and Sanctum
- **Editor**: CKEditor 5 for rich text content
- **Build Tools**: Vite 7.x for asset compilation
- **Testing**: Pest PHP for testing
- **Code Quality**: Laravel Pint for code formatting

The platform appears to be designed for course management with different user roles (instructors, admins) and course creation capabilities.

## Core Architecture

### User Roles & Route Structure
- **Public routes** (`routes/web.php`): Basic welcome page
- **Admin routes** (`routes/admin.php`): Admin dashboard at `/admin`
- **Instructor routes** (`routes/instructor.php`): Course management at `/instructor/courses`

### Key Models & Relationships
- **Course** (`app/Models/Course.php`): Central entity with relationships to User (teacher), Level, Category, and Price
- **User**: Teachers/instructors who create courses
- **Category**: Course categorization
- **Level**: Course difficulty levels
- **Price**: Course pricing tiers

### Database Schema
Recent migrations show the core entities:
- Users table with two-factor authentication
- Levels, Categories, Prices, and Courses tables
- Course status managed via `CourseStatus` enum

### Controllers
- **CourseController** (`app/Http/Controllers/Instructor/CourseController.php`): Main CRUD operations for course management
- Standard Laravel resource controller pattern with validation

## Development Commands

### Backend (Laravel/PHP)
```bash
# Start development server with queue worker and Vite
composer run dev

# Run tests
composer run test
# or
php artisan test

# Code formatting
./vendor/bin/pint

# Database operations
php artisan migrate
php artisan db:seed

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Frontend (Vite/Node.js)
```bash
# Development server (auto-reload)
npm run dev

# Production build
npm run build
```

### Database
Uses SQLite (`database/database.sqlite`) for local development.

## Key Directories

- `app/Models/`: Eloquent models with relationships
- `app/Http/Controllers/`: Controllers organized by user role
- `app/Enums/`: Type-safe enums (e.g., CourseStatus)
- `app/Actions/`: Fortify/Jetstream authentication actions
- `resources/views/`: Blade templates organized by role (admin/, instructor/)
- `routes/`: Route files separated by user role
- `database/migrations/`: Database schema definitions

## Technology Stack Details

### Laravel Features Used
- **Jetstream**: Authentication scaffolding with teams support
- **Livewire**: Dynamic frontend components
- **Sanctum**: API authentication
- **Fortify**: Authentication backend

### Frontend Stack
- **Tailwind CSS**: Utility-first CSS framework with forms and typography plugins
- **Vite**: Modern build tool replacing Laravel Mix
- **CKEditor 5**: Rich text editor for course content

## File Storage
Course images use Laravel's Storage facade with a default fallback image from metasync.com CDN.