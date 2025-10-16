<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('package_schedules', function (Blueprint $table) {
$table->id();
$table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
$table->date('depart_date');
$table->unsignedSmallInteger('seats_quota')->default(20);
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('package_schedules'); }
};