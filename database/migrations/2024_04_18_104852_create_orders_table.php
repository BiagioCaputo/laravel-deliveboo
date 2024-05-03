<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('customer_name', 150);
            $table->string('customer_address', 150);
            $table->string('customer_email', 150);
            $table->char('customer_phone', 20);


            $table->decimal('total_price', 6, 2);
            $table->boolean('status');

            $table->unsignedSmallInteger('month')->nullable();
            $table->unsignedSmallInteger('year')->nullable(); //unsigned a differenza di smallint non può avere valori negativi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
