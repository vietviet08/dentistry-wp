# 🏥 Dentistry Website - System Specification

**Tech Stack:** Laravel 12 + Livewire (Volt/Flux) + Fortify (2FA) + Tailwind CSS + Vite + PostgreSQL

---

## 1️⃣ USE CASES

### 👤 **Guest (Anonymous)**
```
About & Info
├─ View clinic info, mission/vision
├─ Browse services list (general/cosmetic/emergency)
├─ View doctor profiles & specializations
├─ Browse gallery (before/after photos)
├─ Read blog posts (SEO optimized)
├─ View pricing/packages
└─ Contact form submission

Appointment (Limited)
└─ View available time slots (read-only)
```

### 🦷 **Patient (Authenticated)**
```
Profile Management
├─ Complete profile (allergies, insurance)
├─ View medical history
├─ Upload documents/X-rays
└─ Enable/Disable 2FA

Appointment Booking
├─ Book appointment (select service/doctor/time)
├─ View upcoming appointments
├─ Cancel appointment (with conditions)
├─ Reschedule appointment
├─ Receive email/SMS reminders (queued)
└─ Download appointment QR code

Reviews & Feedback
├─ Rate completed appointments
├─ Write reviews (after appointment done)
└─ View own review history

Dashboard
├─ View appointment history
├─ See treatment progress
└─ Access invoices/receipts
```

### 👨‍⚕️ **Admin (Staff/Doctor/Manager)**
```
Content Management
├─ CRUD Services (name, description, duration, price)
├─ CRUD Doctors (bio, specialization, photo)
├─ CRUD Blog posts (with SEO meta)
├─ CRUD Gallery items
├─ Update clinic info/hours
└─ Manage pricing/packages

Appointment Management
├─ View all appointments (calendar view)
├─ Confirm/Reject pending appointments
├─ Mark appointments as done/no-show
├─ Assign doctor to appointment
├─ Set doctor working hours/breaks
├─ Block time slots for holidays
└─ Send manual reminders

Patient Management
├─ View patient list & profiles
├─ Add medical notes
├─ View patient history
└─ Manage patient documents

Analytics & Reports
├─ Appointments statistics
├─ Revenue reports
├─ Popular services
├─ Doctor performance
└─ Patient retention

System
├─ Manage reviews (approve/reject/reply)
├─ View contact form submissions
├─ Manage users & roles
└─ System settings
```

---

## 2️⃣ DATABASE SCHEMA

### **Core Tables**

```sql
-- Users (extends Laravel default)
users
├─ id: bigint PK
├─ name: string
├─ email: string UNIQUE INDEX
├─ email_verified_at: timestamp NULL
├─ password: string
├─ two_factor_secret: text NULL
├─ two_factor_recovery_codes: text NULL
├─ two_factor_confirmed_at: timestamp NULL
├─ role: enum('patient','admin') DEFAULT 'patient' INDEX
├─ phone: string NULL INDEX
├─ date_of_birth: date NULL
├─ avatar: string NULL
├─ is_active: boolean DEFAULT true INDEX
├─ remember_token: string NULL
├─ timestamps
└─ soft_deletes

-- Patient Extended Info
patient_profiles
├─ id: bigint PK
├─ user_id: bigint FK(users) UNIQUE INDEX
├─ address: text NULL
├─ emergency_contact_name: string NULL
├─ emergency_contact_phone: string NULL
├─ allergies: text NULL
├─ medical_conditions: text NULL
├─ insurance_provider: string NULL
├─ insurance_number: string NULL
├─ blood_type: enum('A+','A-','B+','B-','O+','O-','AB+','AB-') NULL
├─ timestamps
└─ INDEX(user_id)

-- Doctors
doctors
├─ id: bigint PK
├─ user_id: bigint FK(users) NULL (if doctor has login)
├─ name: string INDEX
├─ slug: string UNIQUE INDEX
├─ specialization: string INDEX
├─ qualification: text
├─ experience_years: int
├─ bio: text
├─ photo: string NULL
├─ email: string NULL
├─ phone: string NULL
├─ consultation_fee: decimal(10,2)
├─ is_available: boolean DEFAULT true INDEX
├─ order: int DEFAULT 0
├─ timestamps
└─ soft_deletes

-- Doctor Working Hours
doctor_schedules
├─ id: bigint PK
├─ doctor_id: bigint FK(doctors) INDEX
├─ day_of_week: int (0=Sun, 6=Sat) INDEX
├─ start_time: time
├─ end_time: time
├─ break_start: time NULL
├─ break_end: time NULL
├─ slot_duration: int DEFAULT 30 (minutes)
├─ timestamps
└─ UNIQUE(doctor_id, day_of_week)

-- Doctor Time Off / Holidays
doctor_time_offs
├─ id: bigint PK
├─ doctor_id: bigint FK(doctors) INDEX
├─ date: date INDEX
├─ start_time: time NULL (null = all day)
├─ end_time: time NULL
├─ reason: string NULL
├─ timestamps
└─ INDEX(doctor_id, date)

-- Services
services
├─ id: bigint PK
├─ name: string INDEX
├─ slug: string UNIQUE INDEX
├─ category: enum('general','cosmetic','orthodontics','surgery','emergency','pediatric') INDEX
├─ description: text
├─ duration: int (minutes)
├─ price: decimal(10,2)
├─ is_active: boolean DEFAULT true INDEX
├─ order: int DEFAULT 0
├─ icon: string NULL
├─ image: string NULL
├─ meta_title: string NULL
├─ meta_description: text NULL
├─ timestamps
└─ soft_deletes

-- Appointments
appointments
├─ id: bigint PK
├─ patient_id: bigint FK(users) INDEX
├─ doctor_id: bigint FK(doctors) INDEX
├─ service_id: bigint FK(services) INDEX
├─ appointment_date: date INDEX
├─ appointment_time: time INDEX
├─ end_time: time (calculated)
├─ status: enum('pending','confirmed','completed','cancelled','no_show') DEFAULT 'pending' INDEX
├─ notes: text NULL (patient notes)
├─ admin_notes: text NULL (admin/doctor notes)
├─ cancellation_reason: text NULL
├─ cancelled_by: bigint FK(users) NULL
├─ confirmed_by: bigint FK(users) NULL
├─ confirmed_at: timestamp NULL
├─ cancelled_at: timestamp NULL
├─ reminder_sent_at: timestamp NULL
├─ qr_code: string NULL
├─ timestamps
├─ soft_deletes
├─ INDEX(appointment_date, appointment_time)
├─ INDEX(patient_id, status)
└─ UNIQUE(doctor_id, appointment_date, appointment_time) WHERE status != 'cancelled'

-- Medical Records
medical_records
├─ id: bigint PK
├─ appointment_id: bigint FK(appointments) INDEX
├─ patient_id: bigint FK(users) INDEX
├─ diagnosis: text
├─ treatment: text
├─ prescription: text NULL
├─ next_visit_date: date NULL
├─ notes: text NULL
├─ created_by: bigint FK(users)
├─ timestamps
└─ INDEX(patient_id, created_at)

-- Patient Documents
patient_documents
├─ id: bigint PK
├─ patient_id: bigint FK(users) INDEX
├─ type: enum('xray','lab_report','insurance','medical_certificate','other')
├─ title: string
├─ file_path: string
├─ file_size: int
├─ mime_type: string
├─ uploaded_by: bigint FK(users)
├─ timestamps
└─ INDEX(patient_id, type)

-- Reviews
reviews
├─ id: bigint PK
├─ patient_id: bigint FK(users) INDEX
├─ appointment_id: bigint FK(appointments) NULL INDEX
├─ doctor_id: bigint FK(doctors) NULL INDEX
├─ rating: tinyint (1-5)
├─ comment: text NULL
├─ status: enum('pending','approved','rejected') DEFAULT 'pending' INDEX
├─ admin_reply: text NULL
├─ replied_by: bigint FK(users) NULL
├─ replied_at: timestamp NULL
├─ is_featured: boolean DEFAULT false
├─ timestamps
├─ soft_deletes
└─ INDEX(status, is_featured)

-- Blog Posts
posts
├─ id: bigint PK
├─ author_id: bigint FK(users) INDEX
├─ title: string
├─ slug: string UNIQUE INDEX
├─ excerpt: text NULL
├─ content: longtext
├─ featured_image: string NULL
├─ category: string INDEX
├─ tags: json NULL
├─ status: enum('draft','published','archived') DEFAULT 'draft' INDEX
├─ published_at: timestamp NULL INDEX
├─ views_count: int DEFAULT 0
├─ meta_title: string NULL
├─ meta_description: text NULL
├─ meta_keywords: text NULL
├─ timestamps
├─ soft_deletes
└─ FULLTEXT(title, excerpt, content)

-- Gallery
gallery_items
├─ id: bigint PK
├─ title: string
├─ category: enum('facility','team','treatments','before_after')
├─ image_path: string
├─ thumbnail_path: string NULL
├─ description: text NULL
├─ is_before_after: boolean DEFAULT false
├─ before_image: string NULL (if before_after)
├─ after_image: string NULL (if before_after)
├─ order: int DEFAULT 0
├─ is_featured: boolean DEFAULT false
├─ timestamps
└─ INDEX(category, is_featured)

-- Pricing Packages
pricing_packages
├─ id: bigint PK
├─ name: string
├─ description: text NULL
├─ price: decimal(10,2)
├─ duration: string (e.g., "per visit", "monthly")
├─ features: json (array of features)
├─ is_popular: boolean DEFAULT false
├─ is_active: boolean DEFAULT true
├─ order: int DEFAULT 0
├─ timestamps
└─ INDEX(is_active, order)

-- Contact Form Submissions
contact_submissions
├─ id: bigint PK
├─ name: string INDEX
├─ email: string INDEX
├─ phone: string NULL
├─ subject: string
├─ message: text
├─ status: enum('new','read','replied','archived') DEFAULT 'new' INDEX
├─ replied_at: timestamp NULL
├─ replied_by: bigint FK(users) NULL
├─ ip_address: string NULL
├─ user_agent: text NULL
├─ timestamps
└─ INDEX(status, created_at)

-- Clinic Settings (key-value store)
settings
├─ id: bigint PK
├─ key: string UNIQUE INDEX
├─ value: text NULL
├─ type: enum('string','text','boolean','integer','json') DEFAULT 'string'
├─ group: string INDEX (e.g., 'general','contact','social','seo')
├─ timestamps
```

### **Laravel Default Tables (included)**
```
password_reset_tokens
sessions
cache
cache_locks
jobs
job_batches
failed_jobs
```

---

## 3️⃣ APPOINTMENT BOOKING FLOW

```
┌─────────────────────────────────────────────┐
│ Patient Selects Service                     │
│ → Fetch services, filter by category        │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│ Select Doctor (filtered by service)         │
│ → Query doctors who can perform service     │
│ → Show only is_available = true             │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│ Select Date (calendar picker)               │
│ → Check doctor_schedules (day_of_week)      │
│ → Exclude dates in doctor_time_offs         │
│ → Disable past dates                        │
│ → Highlight available dates (7-30 days)     │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│ Generate Available Time Slots               │
│                                              │
│ 1. Get doctor schedule for selected day     │
│    (start_time, end_time, break times)      │
│                                              │
│ 2. Get service duration                     │
│                                              │
│ 3. Generate slots:                          │
│    FOR each slot_duration (e.g., 30 min)    │
│      slot_start = current_time              │
│      slot_end = current_time + duration     │
│                                              │
│ 4. Filter out:                              │
│    - Break times                            │
│    - Existing appointments (same doctor)    │
│      WHERE status IN ('confirmed','pending')│
│    - Time offs                              │
│    - Past times (if today)                  │
│                                              │
│ 5. Return available slots                   │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│ Patient Selects Time Slot                   │
│ → Show time slots as buttons                │
│ → Display doctor name, service, fee         │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│ Add Optional Notes                          │
│ → Textarea for symptoms/concerns            │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│ Confirm & Submit                            │
│                                              │
│ DB TRANSACTION:                             │
│   1. Double-check slot still available      │
│      (race condition protection)            │
│                                              │
│   2. Create appointment:                    │
│      status = 'pending'                     │
│      calculate end_time                     │
│      generate qr_code                       │
│                                              │
│   3. Dispatch Jobs:                         │
│      - AppointmentConfirmationEmail         │
│      - ScheduleAppointmentReminder          │
│        (run 24h before appointment)         │
│                                              │
│   4. Commit transaction                     │
│                                              │
│ Return: Success message + appointment ID    │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│ Confirmation Page                           │
│ → Show appointment details                  │
│ → Display QR code                           │
│ → Download ICS calendar file                │
│ → Email sent notification                   │
└─────────────────────────────────────────────┘
```

### **Validation Rules**
```php
// Appointment Booking Validation
- service_id: required, exists in services where is_active=true
- doctor_id: required, exists in doctors where is_available=true
- appointment_date: required, date, after:today, before:+30 days
- appointment_time: required, time format
- Unique constraint: doctor + date + time (where status != cancelled)
- Working hours: time must be within doctor's schedule
- Slot availability: no overlapping appointments
```

---

## 4️⃣ AUTHORIZATION (Policy/Gate)

### **Roles**
```php
// User model enum
role: 'patient' | 'admin'

// Admin can be further divided (optional):
// admin_type: 'doctor' | 'receptionist' | 'manager'
```

### **Policies**

```php
// app/Policies/AppointmentPolicy.php
class AppointmentPolicy
{
    view(User $user, Appointment $appointment)
    └─ $user->role === 'admin' OR $user->id === $appointment->patient_id

    create(User $user)
    └─ $user->role === 'patient' AND $user->is_active

    update(User $user, Appointment $appointment)
    └─ false (use specific actions: reschedule, cancel)

    cancel(User $user, Appointment $appointment)
    └─ ($user->id === $appointment->patient_id 
        AND $appointment->status === 'pending'
        AND $appointment->appointment_date >= today())
       OR $user->role === 'admin'

    reschedule(User $user, Appointment $appointment)
    └─ ($user->id === $appointment->patient_id
        AND $appointment->status IN ['pending','confirmed']
        AND $appointment->appointment_date >= today())
       OR $user->role === 'admin'

    confirm(User $user, Appointment $appointment)
    └─ $user->role === 'admin' AND $appointment->status === 'pending'

    complete(User $user, Appointment $appointment)
    └─ $user->role === 'admin' AND $appointment->status === 'confirmed'

    viewAny(User $user)
    └─ true (patients see own, admins see all)
}

// app/Policies/ReviewPolicy.php
class ReviewPolicy
{
    create(User $user)
    └─ Appointment::where('patient_id', $user->id)
                  ->where('status', 'completed')
                  ->whereDoesntHave('review')
                  ->exists()

    update(User $user, Review $review)
    └─ $user->id === $review->patient_id AND $review->status === 'pending'

    delete(User $user, Review $review)
    └─ $user->id === $review->patient_id OR $user->role === 'admin'

    moderate(User $user)
    └─ $user->role === 'admin'
}

// app/Policies/PostPolicy.php
class PostPolicy
{
    viewAny(User $user)
    └─ true (public can view published)

    view(?User $user, Post $post)
    └─ $post->status === 'published' 
       OR ($user && $user->role === 'admin')

    create(User $user)
    └─ $user->role === 'admin'

    update(User $user, Post $post)
    └─ $user->role === 'admin'

    delete(User $user, Post $post)
    └─ $user->role === 'admin'
}
```

### **Gates**

```php
// app/Providers/AppServiceProvider.php (or AuthServiceProvider)

Gate::define('access-admin-panel', fn(User $user) => 
    $user->role === 'admin'
);

Gate::define('manage-users', fn(User $user) => 
    $user->role === 'admin'
);

Gate::define('manage-content', fn(User $user) => 
    $user->role === 'admin'
);

Gate::define('view-analytics', fn(User $user) => 
    $user->role === 'admin'
);

Gate::define('manage-appointments', fn(User $user) => 
    $user->role === 'admin'
);
```

### **Middleware Usage**

```php
// routes/web.php

// Public routes (no auth)
Route::get('/', HomePage::class)->name('home');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/services', ServiceListPage::class);
Route::get('/services/{slug}', ServiceDetailPage::class);
Route::get('/doctors', DoctorListPage::class);
Route::get('/blog', BlogListPage::class);
Route::get('/blog/{slug}', BlogDetailPage::class);
Route::get('/gallery', GalleryPage::class);
Route::get('/contact', ContactPage::class);

// Patient routes (auth required)
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', PatientDashboard::class)->name('dashboard');
    Route::get('/appointments', AppointmentList::class);
    Route::get('/appointments/create', AppointmentCreate::class);
    Route::get('/profile', ProfilePage::class);
    Route::get('/medical-history', MedicalHistory::class);
});

// Admin routes
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->group(function() {
    Route::get('/', AdminDashboard::class)->name('admin.dashboard');
    
    Route::prefix('appointments')->group(function() {
        Route::get('/', AdminAppointmentList::class);
        Route::get('/calendar', AppointmentCalendar::class);
    });
    
    Route::prefix('patients')->group(function() {
        Route::get('/', PatientList::class);
        Route::get('/{user}', PatientDetail::class);
    });
    
    Route::prefix('services')->group(function() {
        Route::get('/', ServiceManage::class);
        Route::get('/{service}/edit', ServiceEdit::class);
    });
    
    // ... more admin routes
});
```

---

## 5️⃣ LIVEWIRE ARCHITECTURE

### **Component Tree Structure**

```
📁 resources/views/livewire/

PUBLIC PAGES (Volt single-file)
├─ pages/
│  ├─ home.blade.php (Volt)
│  ├─ about.blade.php (Volt)
│  ├─ services/
│  │  ├─ index.blade.php (Volt - list with filters)
│  │  └─ show.blade.php (Volt - detail + booking CTA)
│  ├─ doctors/
│  │  ├─ index.blade.php (Volt - grid with search)
│  │  └─ show.blade.php (Volt - profile + schedule)
│  ├─ blog/
│  │  ├─ index.blade.php (Volt - pagination + categories)
│  │  └─ show.blade.php (Volt - post + related)
│  ├─ gallery.blade.php (Volt - masonry layout)
│  ├─ pricing.blade.php (Volt - package cards)
│  └─ contact.blade.php (Volt - form + map)

PATIENT DASHBOARD (Class-based for complexity)
├─ patient/
│  ├─ Dashboard.php (widget cards)
│  ├─ appointments/
│  │  ├─ AppointmentList.php (table + filters)
│  │  ├─ AppointmentCreate.php (multi-step wizard)
│  │  │  └─ [Uses nested components below]
│  │  ├─ AppointmentDetail.php (view + actions)
│  │  └─ AppointmentCancel.php (modal)
│  ├─ profile/
│  │  ├─ ProfileEdit.php
│  │  ├─ MedicalInfo.php
│  │  └─ DocumentUpload.php
│  └─ reviews/
│     ├─ ReviewForm.php
│     └─ ReviewList.php

ADMIN PANEL (Class-based)
├─ admin/
│  ├─ Dashboard.php (analytics widgets)
│  ├─ appointments/
│  │  ├─ AppointmentTable.php (data table + inline actions)
│  │  ├─ AppointmentCalendar.php (FullCalendar integration)
│  │  └─ AppointmentModal.php (view/edit)
│  ├─ patients/
│  │  ├─ PatientTable.php
│  │  └─ PatientDetail.php (tabs: info/history/documents)
│  ├─ services/
│  │  ├─ ServiceTable.php (sortable, inline edit)
│  │  └─ ServiceForm.php (create/edit modal)
│  ├─ doctors/
│  │  ├─ DoctorTable.php
│  │  ├─ DoctorForm.php
│  │  └─ ScheduleManager.php (weekly schedule editor)
│  ├─ blog/
│  │  ├─ PostTable.php
│  │  └─ PostEditor.php (rich editor)
│  ├─ gallery/
│  │  ├─ GalleryManager.php (upload + organize)
│  │  └─ ImageUploader.php
│  ├─ reviews/
│  │  └─ ReviewModeration.php (approve/reject/reply)
│  ├─ settings/
│  │  ├─ GeneralSettings.php
│  │  ├─ ContactSettings.php
│  │  └─ SeoSettings.php
│  └─ analytics/
│     └─ Reports.php (charts + exports)

SHARED COMPONENTS (Reusable)
├─ components/
│  ├─ booking/
│  │  ├─ ServiceSelector.php
│  │  ├─ DoctorSelector.php
│  │  ├─ DatePicker.php
│  │  └─ TimeSlotPicker.php (checks availability)
│  ├─ reviews/
│  │  └─ ReviewCard.php
│  ├─ ui/
│  │  ├─ DataTable.php (generic with sorting/filtering)
│  │  ├─ Modal.php
│  │  ├─ Alert.php
│  │  ├─ SearchBar.php
│  │  └─ Pagination.php
│  └─ forms/
│     ├─ ImageUpload.php
│     ├─ DateTimePicker.php
│     └─ RichTextEditor.php
```

### **Volt vs Class-Based Decision Matrix**

| Use Volt (Single-File) | Use Class-Based |
|------------------------|-----------------|
| ✅ Public pages (mostly display) | ✅ Complex business logic |
| ✅ Simple forms (contact) | ✅ Multi-step wizards |
| ✅ Content pages (about, blog post) | ✅ Heavy data manipulation |
| ✅ Static + minor interactivity | ✅ Real-time updates (polling/echo) |
| ✅ SEO-critical pages | ✅ Admin CRUD with validations |
| | ✅ Reusable components with props |

### **Example Volt Component**

```php
// resources/views/livewire/pages/services/index.blade.php
<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public $category = '';
    
    public function with(): array
    {
        return [
            'services' => Service::where('is_active', true)
                ->when($this->category, fn($q) => $q->where('category', $this->category))
                ->orderBy('order')
                ->get(),
            'categories' => Service::distinct('category')->pluck('category')
        ];
    }
}; ?>

<div>
    <x-slot name="title">Our Services</x-slot>
    
    <!-- Category Filter -->
    <div class="flex gap-2 mb-6">
        <button wire:click="$set('category', '')" 
                class="@if(!$category) active @endif">All</button>
        @foreach($categories as $cat)
            <button wire:click="$set('category', '{{ $cat }}')"
                    class="@if($category === $cat) active @endif">
                {{ ucfirst($cat) }}
            </button>
        @endforeach
    </div>
    
    <!-- Services Grid -->
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($services as $service)
            <flux:card wire:key="service-{{ $service->id }}">
                <flux:heading>{{ $service->name }}</flux:heading>
                <flux:subheading>{{ $service->duration }} min • ${{ $service->price }}</flux:subheading>
                <p>{{ Str::limit($service->description, 100) }}</p>
                <flux:button href="{{ route('services.show', $service->slug) }}">
                    Learn More
                </flux:button>
            </flux:card>
        @endforeach
    </div>
</div>
```

### **Example Class-Based Component**

```php
// app/Livewire/Patient/Appointments/AppointmentCreate.php
namespace App\Livewire\Patient\Appointments;

use Livewire\Component;
use Livewire\Attributes\Validate;

class AppointmentCreate extends Component
{
    public $step = 1;
    
    #[Validate('required|exists:services,id')]
    public $service_id;
    
    #[Validate('required|exists:doctors,id')]
    public $doctor_id;
    
    #[Validate('required|date|after:today')]
    public $appointment_date;
    
    #[Validate('required|date_format:H:i')]
    public $appointment_time;
    
    public $notes = '';
    
    // Computed properties
    public function doctors()
    {
        if (!$this->service_id) return collect();
        
        return Doctor::where('is_available', true)
            ->whereHas('services', fn($q) => $q->where('services.id', $this->service_id))
            ->get();
    }
    
    public function availableSlots()
    {
        if (!$this->doctor_id || !$this->appointment_date) {
            return collect();
        }
        
        return app(AppointmentService::class)
            ->getAvailableSlots($this->doctor_id, $this->appointment_date);
    }
    
    // Actions
    public function nextStep()
    {
        $this->validate($this->getStepValidation());
        $this->step++;
    }
    
    public function previousStep()
    {
        $this->step--;
    }
    
    public function submit()
    {
        $this->validate();
        
        $appointment = Appointment::create([
            'patient_id' => auth()->id(),
            'service_id' => $this->service_id,
            'doctor_id' => $this->doctor_id,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);
        
        // Dispatch jobs
        AppointmentConfirmationEmail::dispatch($appointment);
        ScheduleAppointmentReminder::dispatch($appointment)
            ->delay($appointment->appointment_datetime->subDay());
        
        session()->flash('success', 'Appointment booked successfully!');
        return redirect()->route('appointments.show', $appointment);
    }
    
    public function render()
    {
        return view('livewire.patient.appointments.appointment-create');
    }
    
    private function getStepValidation()
    {
        return match($this->step) {
            1 => ['service_id' => 'required|exists:services,id'],
            2 => ['doctor_id' => 'required|exists:doctors,id'],
            3 => ['appointment_date' => 'required|date|after:today'],
            4 => ['appointment_time' => 'required|date_format:H:i'],
            default => []
        };
    }
}
```

---

## 6️⃣ SEO, CACHING, QUEUE, STORAGE

### **SEO Strategy**

```php
✅ Slug Generation
├─ Auto-generate from title (services, doctors, posts)
├─ Ensure uniqueness with suffix if needed
└─ Store in slug column (indexed)

✅ Meta Tags (per model)
├─ meta_title (60 chars)
├─ meta_description (160 chars)
├─ meta_keywords (optional)
└─ og:image (social sharing)

✅ Structured Data (JSON-LD)
├─ Organization (clinic info)
├─ LocalBusiness (address, hours, phone)
├─ Service (each service page)
├─ Doctor (Person schema)
├─ Review (AggregateRating)
└─ BlogPosting (articles)

✅ Sitemap
├─ Auto-generate with spatie/laravel-sitemap
├─ Include: services, doctors, blog posts
├─ Update frequency: daily
└─ robots.txt with sitemap URL

✅ URL Structure
├─ /services/{slug}
├─ /doctors/{slug}
├─ /blog/{slug}
├─ /blog/category/{category}
└─ Clean, descriptive URLs

✅ Performance
├─ Image optimization (resize on upload)
├─ Lazy loading images
├─ Minify CSS/JS (Vite)
└─ CDN for static assets (later)
```

### **Caching Strategy**

```php
✅ Database Query Cache
// Cache frequently accessed data
Cache::remember('services.active', 3600, fn() =>
    Service::where('is_active', true)->orderBy('order')->get()
);

Cache::remember("doctor.{$slug}", 3600, fn() =>
    Doctor::where('slug', $slug)->firstOrFail()
);

✅ View Cache (for public pages)
// Cache rendered pages for guests
Cache::remember("page.home", 3600, fn() =>
    view('livewire.pages.home')->render()
);

✅ Model Cache Events
// Auto-clear cache when model updated
class Service extends Model
{
    protected static function booted()
    {
        static::saved(fn() => Cache::forget('services.active'));
        static::deleted(fn() => Cache::forget('services.active'));
    }
}

✅ Cache Tags (if using Redis)
Cache::tags(['services'])->remember('list', 3600, fn() => ...);
Cache::tags(['services'])->flush(); // Clear all service caches

✅ Rate Limiting
// Protect public forms
RateLimiter::for('contact', fn() =>
    Limit::perMinute(2)->by(auth()->id() ?? request()->ip())
);

✅ Cache Driver Priority
1. Local dev: file
2. Production: redis (optional)
3. Session: database (for Livewire)
```

### **Queue Strategy**

```php
✅ Queue Driver
├─ Local dev: sync (immediate)
├─ Production: database (start with this)
└─ Scale up: redis (if needed)

✅ Jobs to Queue

// Emails (high priority)
├─ AppointmentConfirmationEmail (immediate)
├─ AppointmentReminderEmail (scheduled)
├─ AppointmentCanceledEmail
├─ ContactFormSubmissionEmail
└─ ReviewApprovedNotification

// Scheduled Jobs
├─ SendDailyAppointmentReminders (daily at 8am)
├─ SendUpcomingAppointmentReminders (every hour)
├─ CleanupCanceledAppointments (weekly)
└─ GenerateMonthlyReports (monthly)

// Background Tasks
├─ ProcessImageUpload (resize, optimize)
├─ GenerateSitemap (after content update)
└─ ExportReportPDF

✅ Queue Configuration
// config/queue.php
'connections' => [
    'database' => [
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
    ],
],

✅ Job Example
class AppointmentReminderEmail implements ShouldQueue
{
    use Queueable;
    
    public $tries = 3;
    public $timeout = 30;
    
    public function __construct(
        public Appointment $appointment
    ) {}
    
    public function handle()
    {
        Mail::to($this->appointment->patient->email)
            ->send(new AppointmentReminderMail($this->appointment));
        
        $this->appointment->update(['reminder_sent_at' => now()]);
    }
}

✅ Scheduled Tasks (app/Console/Kernel.php)
protected function schedule(Schedule $schedule)
{
    $schedule->command('appointments:send-reminders')
             ->hourly();
    
    $schedule->command('appointments:cleanup-old')
             ->weekly();
    
    $schedule->command('sitemap:generate')
             ->daily();
}

✅ Running Queues
// Development
php artisan queue:work

// Production (with supervisor)
[program:dentistry-worker]
command=php /path/to/artisan queue:work --sleep=3 --tries=3
```

### **Storage Strategy**

```php
✅ Disk Configuration
// config/filesystems.php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
    
    's3' => [ // For production (future)
        'driver' => 's3',
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION'),
        'bucket' => env('AWS_BUCKET'),
        'url' => env('AWS_URL'),
    ],
],

'default' => env('FILESYSTEM_DISK', 'public'),

✅ Directory Structure
storage/app/public/
├─ avatars/           (user profile photos)
├─ doctors/           (doctor photos)
├─ services/          (service images)
├─ gallery/           (gallery items)
│  ├─ originals/
│  └─ thumbnails/
├─ blog/              (featured images)
├─ documents/         (patient documents)
│  └─ {user_id}/
│     ├─ xrays/
│     ├─ reports/
│     └─ insurance/
└─ temp/              (temporary uploads)

✅ Image Processing
// Use intervention/image
use Intervention\Image\Facades\Image;

public function uploadDoctorPhoto($file)
{
    $filename = Str::uuid() . '.jpg';
    
    // Resize & optimize
    $image = Image::make($file)
        ->fit(800, 800)
        ->encode('jpg', 85);
    
    Storage::disk('public')->put(
        "doctors/{$filename}",
        $image
    );
    
    return "doctors/{$filename}";
}

✅ File Upload Validation
'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
'document' => 'required|file|mimes:pdf,jpg,png|max:5120',

✅ Migration Path to S3
1. Start with local storage
2. When scaling, use S3-compatible (DigitalOcean Spaces, Cloudflare R2)
3. Update FILESYSTEM_DISK=s3 in .env
4. Use Storage::disk('public') everywhere (abstracts the driver)
5. Migrate existing files with artisan command
```

---

## ✅ IMPLEMENTATION CHECKLIST

### **Phase 1: Foundation (Week 1)**
- [ ] Database migrations (all tables)
- [ ] Seeders (test data: services, doctors, schedules)
- [ ] User authentication (Fortify with 2FA)
- [ ] Role system (admin/patient gates)
- [ ] Base layout (Flux components)

### **Phase 2: Public Pages (Week 2)**
- [ ] Homepage (Volt)
- [ ] Services list/detail (Volt)
- [ ] Doctors list/profile (Volt)
- [ ] Blog list/post (Volt)
- [ ] Gallery (Volt)
- [ ] Contact form (Volt + email queue)
- [ ] SEO meta tags + sitemap

### **Phase 3: Appointment System (Week 3)**
- [ ] AppointmentService (slot availability logic)
- [ ] Booking wizard (Livewire class)
  - [ ] Service selector
  - [ ] Doctor selector
  - [ ] Date picker
  - [ ] Time slot picker
  - [ ] Confirmation
- [ ] Appointment policies
- [ ] Email notifications (queued)
- [ ] QR code generation

### **Phase 4: Patient Dashboard (Week 4)**
- [ ] Dashboard widgets
- [ ] Appointment list/detail
- [ ] Cancel/reschedule functionality
- [ ] Profile editing
- [ ] Medical info form
- [ ] Document upload
- [ ] Review submission

### **Phase 5: Admin Panel (Week 5-6)**
- [ ] Admin dashboard (analytics)
- [ ] Appointment management
  - [ ] Table view (filters, search)
  - [ ] Calendar view
  - [ ] Confirm/cancel actions
- [ ] Patient management
  - [ ] Patient list
  - [ ] Patient detail (history, docs)
  - [ ] Medical notes
- [ ] Service CRUD
- [ ] Doctor CRUD + schedule manager
- [ ] Blog post editor (TinyMCE/Trix)
- [ ] Gallery manager
- [ ] Review moderation
- [ ] Settings pages

### **Phase 6: Polish & Optimization (Week 7)**
- [ ] Cache implementation
- [ ] Queue setup (supervisor)
- [ ] Image optimization
- [ ] Rate limiting
- [ ] Error handling
- [ ] Testing (Feature + Unit)
- [ ] Documentation

### **Phase 7: Deployment**
- [ ] Environment config
- [ ] Database backup strategy
- [ ] SSL certificate
- [ ] Queue worker setup
- [ ] Scheduler cron
- [ ] Monitoring (Laravel Telescope)
- [ ] Analytics integration

---

## 📚 DEPENDENCIES

```json
{
  "require": {
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "laravel/fortify": "^1.30",
    "livewire/livewire": "^3.0",
    "livewire/volt": "^1.0",
    "livewire/flux": "^2.0",
    "intervention/image": "^3.0",
    "spatie/laravel-sitemap": "^7.0",
    "simplesoftwareio/simple-qrcode": "^4.2"
  },
  "require-dev": {
    "laravel/pail": "^1.2",
    "laravel/pint": "^1.18",
    "pestphp/pest": "^4.0",
    "pestphp/pest-plugin-laravel": "^4.0"
  }
}
```

---

## 🎯 QUICK START GUIDE

### 1. Clone & Setup
```bash
git clone <repo>
cd dentistry
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### 2. Database
```bash
# Start Docker containers (PostgreSQL + pgAdmin)
docker-compose up -d

# Run migrations
php artisan migrate --seed
```

### 3. Development
```bash
# Terminal 1: Laravel dev server
php artisan serve

# Terminal 2: Vite dev server
npm run dev

# Terminal 3: Queue worker
php artisan queue:work
```

### 4. Access
- **Application**: http://localhost
- **pgAdmin**: http://localhost:5050
  - Email: admin@admin.com
  - Password: admin

---

## 📝 NOTES

- This specification is ready for immediate implementation
- Follow the implementation checklist in order
- Each module can be developed independently after core foundation
- Use feature branches for each module
- Write tests as you build (TDD approach)
- Document API endpoints if building mobile app later

---

**Last Updated:** October 25, 2025
**Version:** 1.0
**Author:** System Architect

