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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('about');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            
            $table->string('facebook');
            $table->string('whatsapp');
            
            $table->string('open_time');
            $table->string('close_time');
            $table->integer('daily_appointments_limit')->default('20');
            $table->integer('appointment_duration')->default('10');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
