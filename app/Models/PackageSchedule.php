<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSchedule extends Model { use HasFactory; protected $fillable=['tour_package_id','depart_date','seats_quota']; public function package(){ return $this->belongsTo(TourPackage::class,'tour_package_id'); } }