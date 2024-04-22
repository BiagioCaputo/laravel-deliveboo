<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name', 50)->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('address', 100);
            $table->char('vat', 11)->unique();
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();

            $table->string('image')->nullable();
            $table->string('logo')->nullable();

            $table->time('opening_hour')->nullable();
            $table->time('closing_hour')->nullable();
            $table->string('opening_days')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Storage::deleteDirectory('restaurant_image');
        Schema::dropIfExists('restaurants');
    }
};
