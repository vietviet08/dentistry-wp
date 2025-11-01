<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update CHECK constraint for role (PostgreSQL only)
        if (DB::getDriverName() === 'pgsql') {
            // Drop existing constraint
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');
            
            // Add new constraint with 'doctor' role
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('patient', 'admin', 'doctor'))");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original constraint
        if (DB::getDriverName() === 'pgsql') {
            // Drop new constraint
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');
            
            // Restore original constraint
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('patient', 'admin'))");
        }
    }
};
