<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'judul',
        'link_video',
        'semester',
        'tahun_akademik',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function getNamaDosenAttribute()
    {
        return $this->booking->user->name ?? 'Unknown';
    }
    public function getNamaProdiAttribute()
    {
        return $this->booking->prodi->name ?? '-';
    }
}
