<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_package_id',
        'schedule_id',
        'pax',
        'total_price',
        'status',
        'booked_at',
        'paid_at',
        'payment_proof_path', // kolom bukti pembayaran
    ];

    protected $casts = [
        'booked_at' => 'datetime',
        'paid_at'   => 'datetime',
    ];

    // RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id');
    }

    public function schedule()
    {
        return $this->belongsTo(PackageSchedule::class, 'schedule_id');
    }
}
