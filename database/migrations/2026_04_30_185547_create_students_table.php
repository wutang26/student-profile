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
        Schema::create('students', function (Blueprint $table) {
             $table->id();
        // Identity
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('force_number')->unique();
            $table->string('nida')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();

            // Contact
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            // Origin / Location
            $table->string('origin_region')->nullable();
            $table->string('origin_district')->nullable();
            $table->string('entry_region')->nullable();

            // Academic
            $table->string('course')->nullable();
            $table->string('company')->nullable();
            $table->string('platoon')->nullable();
            $table->string('year_of_study')->nullable();

             // Intake Year
            // ✅ Intake Year
            $table->string('intake')->nullable();

            // Family
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_relationship')->nullable();
            $table->string('next_of_kin_address')->nullable();

            // System
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'inactive', 'graduated', 'dismissed'])->default('active');
            $table->text('comment')->nullable();

            $table->timestamps();
            $table->softDeletes();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
