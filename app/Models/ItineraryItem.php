<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryItem extends Model { use HasFactory; protected $fillable=['tour_package_id','day_number','title','description']; public function package(){ return $this->belongsTo(TourPackage::class); } }