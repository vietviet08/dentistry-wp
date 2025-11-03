<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Session;

// Health check endpoint for load balancer
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()->toIso8601String(),
    ]);
})->name('health');

// Locale Switch Route
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'en'])) {
        Session::put('locale', $locale);
        
        // Save to user if authenticated
        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }
    }
    
    return redirect()->back();
})->name('locale.switch');

// Public Routes
Volt::route('/', 'pages.home')->name('home');
Volt::route('/about', 'pages.about')->name('about');
Volt::route('/about-us', 'pages.about-us')->name('about-us');
Volt::route('/services', 'pages.services')->name('services');
Volt::route('/services/{service}', 'pages.service-detail')->name('service-detail');
Volt::route('/team', 'pages.team')->name('team');
Volt::route('/team/{doctor}', 'pages.doctor-detail')->name('doctor-detail');
Volt::route('/testimonials', 'pages.testimonials')->name('testimonials');
Volt::route('/blog', 'pages.blog')->name('blog');
Volt::route('/blog/{post}', 'pages.blog-detail')->name('blog-detail');
Volt::route('/faqs', 'pages.faqs')->name('faqs');
Volt::route('/contact', 'pages.contact')->name('contact');
Volt::route('/gallery', 'pages.gallery')->name('gallery');

// New Auth Page (Split Layout with Tabs)
Volt::route('/auth', 'auth.auth-page')->name('auth');

// Authentication Routes (handled by Fortify)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', \App\Livewire\Patient\Dashboard::class)->name('dashboard');

    // Appointments
    Route::get('/appointments', \App\Livewire\Patient\Appointments\AppointmentList::class)->name('appointments.index');
    Route::get('/appointments/create', \App\Livewire\Patient\Appointments\AppointmentCreate::class)->name('appointments.create');
    Route::get('/appointments/{appointment}', \App\Livewire\Patient\Appointments\AppointmentDetail::class)->name('appointments.show');

    // Profile Management
    Route::get('/profile/edit', \App\Livewire\Patient\Profile\ProfileEdit::class)->name('profile.edit');
    Route::get('/profile/medical', \App\Livewire\Patient\Profile\MedicalInfo::class)->name('profile.medical');

    // Documents
    Route::get('/documents', \App\Livewire\Patient\Documents\DocumentUpload::class)->name('documents.index');

    // Reviews
    Route::get('/reviews', \App\Livewire\Patient\Reviews\ReviewList::class)->name('reviews.index');
    Route::get('/reviews/create/{appointment}', \App\Livewire\Patient\Reviews\ReviewForm::class)->name('reviews.create');

    // Settings routes
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('profile.settings');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Admin Routes
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
    
    // Appointments
    Route::prefix('appointments')->group(function () {
        Route::get('/', \App\Livewire\Admin\Appointments\AppointmentTable::class)->name('appointments.index');
        Route::get('/calendar', \App\Livewire\Admin\Appointments\AppointmentCalendar::class)->name('appointments.calendar');
        Route::get('/{appointment}', \App\Livewire\Admin\Appointments\AppointmentDetail::class)->name('appointments.show');
    });
    
    // Patients
    Route::prefix('patients')->group(function () {
        Route::get('/', \App\Livewire\Admin\Patients\PatientTable::class)->name('patients.index');
        Route::get('/{user}', \App\Livewire\Admin\Patients\PatientDetail::class)->name('patients.show');
    });
    
    // Services
    Route::prefix('services')->group(function () {
        Route::get('/', \App\Livewire\Admin\Services\ServiceTable::class)->name('services.index');
        Route::get('/create', \App\Livewire\Admin\Services\ServiceForm::class)->name('services.create');
        Route::get('/{service}/edit', \App\Livewire\Admin\Services\ServiceForm::class)->name('services.edit');
    });
    
    // Doctors
    Route::prefix('doctors')->group(function () {
        Route::get('/', \App\Livewire\Admin\Doctors\DoctorTable::class)->name('doctors.index');
        Route::get('/create', \App\Livewire\Admin\Doctors\DoctorForm::class)->name('doctors.create');
        Route::get('/{doctor}/edit', \App\Livewire\Admin\Doctors\DoctorForm::class)->name('doctors.edit');
        Route::get('/{doctor}/schedule', \App\Livewire\Admin\Doctors\ScheduleManager::class)->name('doctors.schedule');
    });
    
    // Blog
    Route::prefix('posts')->group(function () {
        Route::get('/', \App\Livewire\Admin\Posts\PostTable::class)->name('posts.index');
        Route::get('/create', \App\Livewire\Admin\Posts\PostEditor::class)->name('posts.create');
        Route::get('/{post}/edit', \App\Livewire\Admin\Posts\PostEditor::class)->name('posts.edit');
    });
    
    // Gallery
    Route::get('/gallery', \App\Livewire\Admin\Gallery\GalleryManager::class)->name('gallery.index');
    
    // Reviews
    Route::get('/reviews', \App\Livewire\Admin\Reviews\ReviewModeration::class)->name('reviews.index');
    
    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/general', \App\Livewire\Admin\Settings\GeneralSettings::class)->name('settings.general');
    });
});

// Doctor Routes
Route::middleware(['auth', 'can:access-doctor-panel'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/', \App\Livewire\Doctor\Dashboard::class)->name('dashboard');
    
    // Appointments
    Route::prefix('appointments')->group(function () {
        Route::get('/', \App\Livewire\Doctor\Appointments\AppointmentList::class)->name('appointments.index');
        Route::get('/calendar', \App\Livewire\Doctor\Appointments\AppointmentCalendar::class)->name('appointments.calendar');
        Route::get('/{appointment}', \App\Livewire\Doctor\Appointments\AppointmentDetail::class)->name('appointments.show');
    });
    
    // Schedule
    Route::get('/schedule', \App\Livewire\Doctor\Schedule\ScheduleManager::class)->name('schedule.index');
    
    // Patients
    Route::prefix('patients')->group(function () {
        Route::get('/', \App\Livewire\Doctor\Patients\PatientList::class)->name('patients.index');
        Route::get('/{user}', \App\Livewire\Doctor\Patients\PatientDetail::class)->name('patients.show');
    });
});
