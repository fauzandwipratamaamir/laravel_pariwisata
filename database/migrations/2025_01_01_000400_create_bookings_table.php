<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('bookings', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
$table->foreignId('schedule_id')->nullable()->constrained('package_schedules')->nullOnDelete();
$table->unsignedSmallInteger('pax')->default(1);
$table->unsignedInteger('total_price');
$table->enum('status', ['pending','paid','cancelled'])->default('pending');
$table->timestamp('booked_at')->useCurrent();
$table->timestamp('paid_at')->nullable();
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('bookings'); }
};