<?php

namespace App\Console\Commands;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateUsersForDoctors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctors:create-users {--force : Force update existing user accounts}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user accounts for all doctors that do not have a user_id';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $doctors = Doctor::whereNull('user_id')->get();

        if ($doctors->isEmpty()) {
            $this->info('All doctors already have user accounts.');
            return Command::SUCCESS;
        }

        $this->info("Found {$doctors->count()} doctor(s) without user accounts.");

        $bar = $this->output->createProgressBar($doctors->count());
        $bar->start();

        $created = 0;
        $updated = 0;

        foreach ($doctors as $doctor) {
            // Check if user with doctor's email already exists
            $existingUser = User::where('email', $doctor->email)->first();

            if ($existingUser) {
                if ($existingUser->role !== 'doctor') {
                    $this->newLine();
                    $this->warn("User with email {$doctor->email} exists but has role '{$existingUser->role}'. Skipping...");
                    $bar->advance();
                    continue;
                }

                // Link existing user to doctor
                if ($this->option('force')) {
                    $doctor->update(['user_id' => $existingUser->id]);
                    $existingUser->update([
                        'name' => $doctor->name,
                        'phone' => $doctor->phone ?? $existingUser->phone,
                        'is_active' => $doctor->is_available,
                    ]);
                    $updated++;
                } else {
                    $this->newLine();
                    $this->warn("User with email {$doctor->email} already exists. Use --force to update.");
                    $bar->advance();
                    continue;
                }
            } else {
                // Generate email if not provided
                $email = $doctor->email;
                if (!$email) {
                    $email = $this->generateUniqueEmail($doctor);
                } else {
                    // Ensure email is unique
                    $baseEmail = $email;
                    $counter = 1;
                    while (User::where('email', $email)->exists()) {
                        $email = Str::beforeLast($baseEmail, '@') . $counter . '@' . Str::afterLast($baseEmail, '@');
                        $counter++;
                    }
                }

                // Create new user
                $user = User::create([
                    'name' => $doctor->name,
                    'email' => $email,
                    'password' => bcrypt('password'), // Default password
                    'role' => 'doctor',
                    'is_active' => $doctor->is_available,
                    'email_verified_at' => now(),
                    'phone' => $doctor->phone,
                ]);

                // Link user to doctor
                $doctor->update(['user_id' => $user->id]);
                $created++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("✅ Successfully created {$created} user account(s).");
        if ($updated > 0) {
            $this->info("✅ Updated {$updated} existing user account(s).");
        }

        $this->newLine();
        $this->comment('Default password for all doctor accounts: password');
        $this->comment('Doctors should change their password after first login.');

        return Command::SUCCESS;
    }

    /**
     * Generate a unique email for doctor
     */
    private function generateUniqueEmail(Doctor $doctor): string
    {
        $baseEmail = Str::slug($doctor->name) . '@dentistry.test';
        $email = $baseEmail;
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            $email = Str::slug($doctor->name) . $counter . '@dentistry.test';
            $counter++;
        }

        return $email;
    }
}
