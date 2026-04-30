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

        $table->string('full_name');
        $table->string('force_number')->unique();

        $table->string('phone')->nullable();
        $table->string('next_of_kin')->nullable();

        $table->string('origin_region')->nullable();
        $table->string('entry_region')->nullable();

        $table->text('comment')->nullable();

        $table->enum('status', ['active', 'inactive'])->default('active');

        $table->string('photo')->nullable(); // for profile image

        $table->timestamps();
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
