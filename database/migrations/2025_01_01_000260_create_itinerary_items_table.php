<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('itinerary_items', function (Blueprint $table) {
$table->id();
$table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
$table->unsignedTinyInteger('day_number');
$table->string('title');
$table->text('description')->nullable();
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('itinerary_items'); }
};