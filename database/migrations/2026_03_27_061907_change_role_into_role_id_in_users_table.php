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
        Schema::table('users', function (Blueprint $table) {
            // 1. Buat kolom role_id
            $table->foreignId('role_id')->nullable()->after('password');
            // 2. tambahkan fk
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            // 3. drop column role lama
            $table->dropColumn('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
