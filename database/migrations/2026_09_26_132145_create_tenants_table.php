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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('nik', 16)->unique();
            $table->string('phone', 15);
            $table->string('gender', 20);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->string('occupation');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone', 15);
            $table->string('identity_document')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
