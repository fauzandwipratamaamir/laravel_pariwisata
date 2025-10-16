<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;
    protected $fillable=['category_id','destination_id','title','slug','short_desc','description','base_price','duration_days','is_active'];
    public function category(){ return $this->belongsTo(Category::class); }
    public function destination(){ return $this->belongsTo(Destination::class); }
    public function images(){ return $this->hasMany(PackageImage::class); }
    public function itinerary(){ return $this->hasMany(ItineraryItem::class)->orderBy('day_number'); }
    public function schedules(){ return $this->hasMany(PackageSchedule::class); }
    public function bookings(){ return $this->hasMany(Booking::class); }
}