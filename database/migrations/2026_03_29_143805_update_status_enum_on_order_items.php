<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->enum('status', [
                'pending',
                'paid',
                'processing',
                'shipped',
                'completed',
                'cancelled'
            ])->default('pending')->change();
        });
    }

    public function down(): void
    {
        // mapping balik dulu
        DB::table('order_items')->update([
            'status' => DB::raw("
                CASE 
                    WHEN status = 'pending' THEN 'waiting'
                    WHEN status = 'paid' THEN 'approved'
                    WHEN status = 'processing' THEN 'approved'
                    ELSE status
                END
            ")
        ]);

        // baru ubah enum
        Schema::table('order_items', function (Blueprint $table) {
            $table->enum('status', [
                'waiting',
                'approved',
                'shipped',
                'completed',
                'cancelled'
            ])->default('waiting')->change();
        });
}
};