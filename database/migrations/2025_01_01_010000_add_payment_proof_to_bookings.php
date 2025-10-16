<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_proof_path')->nullable()->after('status');
            // paid_at sudah ada di schema kita. Kalau belum ada di project kamu, uncomment baris di bawah.
            // $table->timestamp('paid_at')->nullable()->after('booked_at');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('payment_proof_path');
            // $table->dropColumn('paid_at');
        });
    }
};
