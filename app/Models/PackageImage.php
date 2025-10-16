<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageImage extends Model { use HasFactory; protected $fillable=['tour_package_id','path']; public function package(){ return $this->belongsTo(TourPackage::class,'tour_package_id'); } }