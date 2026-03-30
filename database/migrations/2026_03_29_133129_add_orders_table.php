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
            // PRIMARY KEY
            $table->id();

            // RELATION
            $table->foreignId('buyer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // DATA
            $table->unsignedBigInteger('total_price');
            $table->string('shipping_address');
            $table->string('phone');
            $table->text('note')->nullable();

            // STATUS ENUM
            $table->enum('status', [
                'waiting_for_payment',
                'waiting_for_approve',
                'waiting_for_refund',
                'approved',
                'processed',
                'shipped',
                'completed',
                'refunded',
                'refund_rejected',
                'cancelled'
            ])->default('waiting_for_approve');

            // TIMESTAMP
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