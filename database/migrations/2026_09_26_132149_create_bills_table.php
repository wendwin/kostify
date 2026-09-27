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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rental_id')
                ->constrained('rentals')
                ->restrictOnDelete();

            $table->date('billing_period');
            $table->date('due_date');

            $table->decimal('amount', 12, 2);
            $table->decimal('late_fee', 12, 2)->default(0);

            $table->enum('status', [
                'unpaid',
                'partial',
                'paid',
                'overdue',
            ]);

            $table->timestamps();

            $table->unique(['rental_id', 'billing_period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
