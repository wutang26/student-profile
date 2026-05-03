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
        Schema::create('borrow_records', function (Blueprint $table) {
            $table->id();
                // ===== BORROWER INFO =====
            $table->string('force_number')->nullable();
            $table->string('borrower_name');

            $table->enum('position', [
                'platoon_leader',
                'karani',
                'oc',
                'company_sergeant_major'
            ])->nullable();

            // ===== ITEM INFO =====
            $table->foreignId('store_item_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('category')->nullable(); // snapshot of category at time of borrow
            $table->integer('quantity');

            // ===== BORROW DETAILS =====
            $table->date('borrow_date');
            $table->text('purpose')->nullable();

            // ===== ISSUING INFO =====
            $table->string('issued_by')->nullable();

            $table->enum('issuer_role', [
                'karani',
                'katibu',
                'company_sergeant_major',
                'instructor',
                'adjutant',
                'chiefinstructor',
                'chiefmatron',
                'commandant',
                'admin'
            ])->nullable();

            // ===== COMPANY INFO =====
            $table->enum('company', [
                'hq-coy',
                'a-coy',
                'b-coy',
                'c-coy'
            ])->nullable();

            // ===== RETURN TRACKING =====
            $table->date('return_date')->nullable();

            $table->enum('status', [
                'borrowed',
                'returned',
                'pending'
            ])->default('borrowed');

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_records');
    }
};
