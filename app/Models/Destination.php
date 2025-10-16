<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model { use HasFactory; protected $fillable=['name','country','city','slug']; public function packages(){ return $this->hasMany(TourPackage::class); } }