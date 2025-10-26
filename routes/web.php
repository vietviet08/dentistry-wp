<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

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
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->group(function () {
    Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
});
