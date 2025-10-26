<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->index();
            $table->string('image_path');
            $table->string('thumbnail_path')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_before_after')->default(false);
            $table->string('before_image')->nullable();
            $table->string('after_image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false)->index();
            $table->timestamps();
            
            $table->index(['category', 'is_featured']);
        });

        if (DB::getDriverName() === 'pgsql') {
            DB::statement("ALTER TABLE gallery_items ADD CONSTRAINT gallery_items_category_check CHECK (category IN ('facility','team','treatments','before_after'))");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE gallery_items DROP CONSTRAINT IF EXISTS gallery_items_category_check');
        }
        Schema::dropIfExists('gallery_items');
    }
};
