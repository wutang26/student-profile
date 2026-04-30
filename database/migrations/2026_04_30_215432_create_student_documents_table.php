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
        Schema::create('student_documents', function (Blueprint $table) {
             $table->id();

            $table->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('type');
            // warning, transfer, medical, discipline, description_letter

            $table->string('title')->nullable();

            $table->string('file_path');

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_documents');
    }
};
