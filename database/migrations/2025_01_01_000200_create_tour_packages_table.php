<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('tour_packages', function (Blueprint $table) {
$table->id();
$table->foreignId('category_id')->constrained()->cascadeOnDelete();
$table->foreignId('destination_id')->constrained()->cascadeOnDelete();
$table->string('title');
$table->string('slug')->unique();
$table->string('short_desc', 280)->nullable();
$table->text('description')->nullable();
$table->unsignedInteger('base_price');
$table->unsignedTinyInteger('duration_days');
$table->boolean('is_active')->default(true);
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('tour_packages'); }
};