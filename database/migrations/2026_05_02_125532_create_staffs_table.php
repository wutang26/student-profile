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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
                // Basic Info
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            // Military Info
            $table->string('force_number')->unique();
            $table->string('rank');
            $table->string('department')->nullable();

            // Contact
            $table->string('phone')->nullable();
            $table->string('email')->unique();

            // Role system
            $table->string('role'); // karani, katibu, etc

            // Authentication (optional if separate users table not used)
            $table->string('password');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
