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
        Schema::table('orders', function (Blueprint $table) {

            // Hapus status lama
            $table->dropColumn('status');

            // Tambah payment_status
            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'expired'
            ])->default('pending')->after('note');

            // Optional (recommended)
            $table->string('midtrans_order_id')->nullable()->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // rollback
            $table->dropColumn('payment_status');
            $table->dropColumn('midtrans_order_id');

            $table->enum('status', [
                'waiting_for_payment',
                'waiting_for_approve'
            ])->default('waiting_for_approve')->after('note');
        });
    }
};