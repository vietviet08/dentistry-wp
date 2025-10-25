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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->text('description');
            $table->integer('duration'); // minutes
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order')->default(0);
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Add CHECK constraint for category (PostgreSQL)
        DB::statement("ALTER TABLE services ADD CONSTRAINT services_category_check CHECK (category IN ('general','cosmetic','orthodontics','surgery','emergency','pediatric'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE services DROP CONSTRAINT IF EXISTS services_category_check');
        Schema::dropIfExists('services');
    }
};
