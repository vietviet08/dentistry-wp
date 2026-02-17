# 🏥 Dentistry Website

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3-4E56A6?style=flat&logo=livewire)](https://livewire.laravel.com)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17-336791?style=flat&logo=postgresql)](https://www.postgresql.org)
[![License](https://img.shields.io/badge/License-Private-red.svg)](LICENSE)

Modern dental clinic management system built with **Laravel 12 + Livewire + PostgreSQL**.

A comprehensive web application for managing dental clinics with features including appointment scheduling, patient records management, doctor profiles, service catalog, and an integrated content management system.

## 📑 Table of Contents

- [Quick Start](#-quick-start)
- [Access URLs](#-access-urls)
- [Tech Stack](#️-tech-stack)
- [Key Features](#-key-features)
- [User Roles](#-user-roles)
- [Project Structure](#-project-structure)
- [Development Commands](#-development-commands)
- [Testing](#-testing)
- [Database Seeding](#-database-seeding)
- [Default Credentials](#-default-credentials)
- [Environment Variables](#-environment-variables)
- [Deployment](#-deployment)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

## 🚀 Quick Start

### Prerequisites

Make sure you have the following installed on your system:

- **PHP** 8.2 or higher
- **Composer** 2.x
- **Node.js** 18.x or higher & NPM
- **Docker** & **Docker Compose** (for containerized setup)
- **PostgreSQL** 17 (if running locally without Docker)

### Installation

#### Option 1: Using Docker (Recommended)

```bash
# 1. Clone the repository
git clone https://github.com/vietviet08/dentistry-wp.git
cd dentistry-wp

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Start Docker services (PostgreSQL + pgAdmin + MinIO)
./vendor/bin/sail up -d
# Or if you don't have Sail alias:
docker compose up -d

# 6. Run database migrations with seeding
./vendor/bin/sail artisan migrate --seed

# 7. Link storage for file uploads
./vendor/bin/sail artisan storage:link

# 8. Start development servers using composer script
composer run dev
# This will start Laravel server, queue worker, and Vite dev server concurrently
```

#### Option 2: Local Development (Without Docker)

```bash
# 1. Clone the repository
git clone https://github.com/vietviet08/dentistry-wp.git
cd dentistry-wp

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Configure database (edit .env file)
# Update DB_HOST=localhost (or your PostgreSQL host)
# Set DB_DATABASE, DB_USERNAME, DB_PASSWORD accordingly

# 5. Run migrations
php artisan migrate --seed

# 6. Link storage
php artisan storage:link

# 7. Start development servers in separate terminals
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite dev server
npm run dev

# Terminal 3 - Queue worker (for email notifications)
php artisan queue:work
```

## 🔗 Access URLs

- **Application**: http://localhost
- **pgAdmin**: http://localhost:5050 (admin@admin.com / admin)
- **PostgreSQL**: localhost:5432
- **MinIO Console**: http://localhost:9001 (minioadmin / minioadmin)
- **MinIO API**: http://localhost:9000

## 📸 Screenshots & Demo

> Add screenshots of your application here to showcase the UI and features

### Homepage
*Coming soon - Add screenshot of the homepage*

### Admin Dashboard
*Coming soon - Add screenshot of the admin dashboard*

### Appointment Booking
*Coming soon - Add screenshot of the appointment booking system*

### Patient Portal
*Coming soon - Add screenshot of the patient portal*

## 📚 Documentation

See [SYSTEM_SPECIFICATION.md](SYSTEM_SPECIFICATION.md) for complete system architecture, database schema, and implementation details.

## 🛠️ Tech Stack

- **Backend**: Laravel 12, Livewire 3, Volt, Fortify
- **Frontend**: Tailwind CSS 4, Flux UI, Vite
- **Database**: PostgreSQL 17
- **Cache/Queue**: Database (Redis optional)
- **Storage**: MinIO (S3-compatible object storage)

## 📦 Key Features

### Authentication & Security
- 🔐 Multi-factor authentication (2FA) with Laravel Fortify
- 👥 Role-based access control (Guest, Patient, Admin)
- 🔒 Secure password hashing and session management

### Appointment Management
- 📅 Smart appointment booking system with real-time availability
- ⏰ Automated appointment reminders via email
- 📊 Appointment status tracking (pending, confirmed, completed, cancelled)
- 🗓️ Calendar view for managing appointments

### Doctor Management
- 👨‍⚕️ Doctor profiles with specializations and qualifications
- 📅 Flexible schedule management with time slots
- ⭐ Patient reviews and ratings system
- 📈 Performance analytics

### Patient Services
- 📝 Complete medical records and history
- 💳 Online appointment booking
- 📧 Email notifications for appointments
- ⭐ Review and rating system for doctors and services

### Content Management
- 📰 Blog/CMS with WYSIWYG editor
- 🖼️ Gallery management for before/after photos
- 🦷 Service catalog with detailed descriptions
- 📄 Dynamic page content management

### Technical Features
- 🔍 SEO optimized with auto-generated sitemaps
- 📧 Queue-based email notifications
- 🗄️ S3-compatible object storage (MinIO)
- 📱 Responsive design with Tailwind CSS
- ⚡ Real-time updates with Livewire
- 📊 Dashboard with analytics and charts

## 👥 User Roles

- **Guest**: Browse services, doctors, blog
- **Patient**: Book appointments, view history, write reviews
- **Admin**: Full system management

## 📂 Project Structure

```
├─ app/
│  ├─ Livewire/          # Livewire components
│  ├─ Models/            # Database models
│  ├─ Policies/          # Authorization policies
│  └─ Services/          # Business logic
├─ database/
│  ├─ migrations/        # Database migrations
│  └─ seeders/           # Test data seeders
├─ resources/
│  ├─ views/livewire/    # Livewire/Volt views
│  ├─ css/              # Styles
│  └─ js/               # JavaScript
└─ routes/
   └─ web.php           # Application routes
```

## 🔧 Development Commands

```bash
# Code formatting with Laravel Pint
./vendor/bin/pint

# Run tests
php artisan test
# or using composer
composer test

# Clear all caches
php artisan optimize:clear

# Generate sitemap
php artisan sitemap:generate

# Run scheduler (cron jobs)
php artisan schedule:run

# Watch queue for jobs
php artisan queue:work

# List all routes
php artisan route:list

# Fresh database with seeding
php artisan migrate:fresh --seed
```

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/AppointmentTest.php

# Run tests with coverage
php artisan test --coverage

# Run tests in parallel
php artisan test --parallel
```

## 📊 Database Seeding

```bash
# Seed all data
php artisan db:seed

# Seed specific seeder
php artisan db:seed --class=ServiceSeeder
php artisan db:seed --class=DoctorSeeder
```

## 🔐 Default Credentials (after seeding)

**Admin Account:**
- Email: admin@dentistry.test
- Password: password

**Test Patient:**
- Email: patient@dentistry.test
- Password: password

⚠️ **Important**: Change these credentials in production!

## 🌍 Environment Variables

Key environment variables you should configure:

```bash
# Application
APP_NAME=Dentistry
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=pgsql                    # or localhost for local setup
DB_PORT=5432
DB_DATABASE=dentistry
DB_USERNAME=postgres
DB_PASSWORD=secret

# Mail Configuration
MAIL_MAILER=smtp                 # Use 'log' for development
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS=hello@dentistry.com
MAIL_FROM_NAME="${APP_NAME}"

# Storage (MinIO/S3)
FILESYSTEM_DISK=local            # or 'minio' for S3-compatible storage
AWS_ACCESS_KEY_ID=minioadmin
AWS_SECRET_ACCESS_KEY=minioadmin
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=dentistry
AWS_ENDPOINT=http://minio:9000
AWS_USE_PATH_STYLE_ENDPOINT=true

# Queue
QUEUE_CONNECTION=database        # or 'redis' for better performance

# Cache
CACHE_STORE=database             # or 'redis' for production
```

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` and `APP_DEBUG=false`
- [ ] Generate new `APP_KEY` with `php artisan key:generate`
- [ ] Configure production database credentials
- [ ] Set up proper mail configuration (SMTP/SendGrid/etc.)
- [ ] Configure S3 or MinIO for file storage
- [ ] Set up Redis for cache and queue (recommended)
- [ ] Configure a proper web server (Nginx/Apache)
- [ ] Set up SSL certificate (Let's Encrypt)
- [ ] Configure cron job for scheduler:
  ```bash
  * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
  ```
- [ ] Set up supervisor for queue workers:
  ```ini
  [program:dentistry-worker]
  process_name=%(program_name)s_%(process_num)02d
  command=php /path-to-your-project/artisan queue:work --sleep=3 --tries=3
  autostart=true
  autorestart=true
  user=www-data
  numprocs=2
  redirect_stderr=true
  stdout_logfile=/path-to-your-project/storage/logs/worker.log
  ```
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `npm run build` for production assets
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set proper file permissions

### Deployment Commands

```bash
# Install dependencies (production)
composer install --optimize-autoloader --no-dev
npm ci
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Run migrations
php artisan migrate --force

# Generate sitemap
php artisan sitemap:generate
```

## 🐛 Troubleshooting

### Common Issues

**Issue: Docker services won't start**
```bash
# Solution: Remove old containers and volumes
docker compose down -v
docker compose up -d
```

**Issue: Permission denied errors**
```bash
# Solution: Fix storage and cache permissions
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

**Issue: Class not found errors**
```bash
# Solution: Regenerate autoloader
composer dump-autoload
```

**Issue: Database connection refused**
```bash
# Solution: Check if PostgreSQL is running
docker compose ps
# or for local setup
sudo systemctl status postgresql
```

**Issue: Vite dev server not working**
```bash
# Solution: Clear node modules and reinstall
rm -rf node_modules package-lock.json
npm install
npm run dev
```

**Issue: Queue jobs not processing**
```bash
# Solution: Restart queue worker
php artisan queue:restart
php artisan queue:work
```

**Issue: MinIO connection errors**
```bash
# Solution: Check MinIO is running and create bucket
docker compose ps
# Access MinIO console at http://localhost:9001
# Login with minioadmin/minioadmin and create 'dentistry' bucket
```

## 📝 License

Private project - All rights reserved

## 🤝 Contributing

This is a private project, but if you're part of the team:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style

- Follow PSR-12 coding standards
- Use Laravel Pint for code formatting: `./vendor/bin/pint`
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

### Development Workflow

1. Pull latest changes from master
2. Create a new branch for your feature
3. Make changes and test locally
4. Run tests: `php artisan test`
5. Format code: `./vendor/bin/pint`
6. Commit and push changes
7. Create a pull request with description

## 📞 Support

For issues, questions, or contributions:
- Create an issue in the repository
- Contact the development team

## 🙏 Acknowledgments

Built with:
- [Laravel](https://laravel.com) - The PHP Framework
- [Livewire](https://livewire.laravel.com) - Dynamic Interfaces
- [Volt](https://livewire.laravel.com/docs/volt) - Functional Programming API for Livewire
- [Flux UI](https://flux.laravel.com) - UI Components
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript
- [PostgreSQL](https://www.postgresql.org) - Advanced Database
- [MinIO](https://min.io) - S3-compatible Storage

---

**For detailed system specifications and architecture**, see [SYSTEM_SPECIFICATION.md](SYSTEM_SPECIFICATION.md)

**Made with ❤️ for modern dental clinics**

