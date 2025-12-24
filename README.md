# 🏥 Dentistry Website

Modern dental clinic management system built with **Laravel 12 + Livewire + PostgreSQL**.

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- Docker & Docker Compose

### Installation

```bash
# 1. Install dependencies
composer install
npm install

# 2. Environment setup
cp .env.example .env
php artisan key:generate

# 3. Start services (PostgreSQL + pgAdmin + MinIO)
./vendor/bin/sail up -d
# hoặc nếu chưa có Sail alias:
docker compose up -d

# 4. Run migrations
php artisan migrate --seed

# 5. Link storage
php artisan storage:link

# 6. Start development servers
# Terminal 1
php artisan serve

# Terminal 2
npm run dev

# Terminal 3 (for queued jobs)
php artisan queue:work
```

## 🔗 Access URLs

- **Application**: http://localhost
- **pgAdmin**: http://localhost:5050 (admin@admin.com / admin)
- **PostgreSQL**: localhost:5432
- **MinIO Console**: http://localhost:9001 (minioadmin / minioadmin)
- **MinIO API**: http://localhost:9000

## 📚 Documentation

See [SYSTEM_SPECIFICATION.md](SYSTEM_SPECIFICATION.md) for complete system architecture, database schema, and implementation details.

## 🛠️ Tech Stack

- **Backend**: Laravel 12, Livewire 3, Volt, Fortify
- **Frontend**: Tailwind CSS 4, Flux UI, Vite
- **Database**: PostgreSQL 17
- **Cache/Queue**: Database (Redis optional)
- **Storage**: MinIO (S3-compatible object storage)

## 📦 Key Features

- 🔐 Authentication with 2FA
- 📅 Smart appointment booking system
- 👨‍⚕️ Doctor schedule management
- 📝 Patient medical records
- ⭐ Review & rating system
- 📰 Blog/CMS
- 🖼️ Gallery management
- 📧 Email notifications (queued)
- 🔍 SEO optimized

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
# Code formatting
./vendor/bin/pint

# Run tests
php artisan test

# Clear caches
php artisan optimize:clear

# Generate sitemap
php artisan sitemap:generate

# Run scheduler (cron)
php artisan schedule:run
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

## 📝 License

Private project - All rights reserved

---

**For detailed specifications**, see [SYSTEM_SPECIFICATION.md](SYSTEM_SPECIFICATION.md)

