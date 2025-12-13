<?php

namespace App\Models;

use Illuminate\Cache\HasCacheLock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_tapping' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function matkul() {
        return $this->belongsTo(Matkul::class);
    }
    public function studio() {
        return $this->belongsTo(Studio::class);
        
    }
    public function video() {
        return $this->hasOne(Video::class);
    }

    //accessor

    public function getStatusBadgeAtribut() {
        return match ($this->status) {
            'Pending'   => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
            'Approved'  => 'bg-blue-100 text-blue-800 border border-blue-200',
            'Taping'    => 'bg-indigo-100 text-indigo-800 border border-indigo-200',
            'Editing'   => 'bg-orange-100 text-orange-800 border border-orange-200',
            'Ready'     => 'bg-purple-100 text-purple-800 border border-purple-200',
            'Published' => 'bg-green-100 text-green-800 border border-green-200',
            'Rejected'  => 'bg-red-100 text-red-800 border border-red-200',
            default     => 'bg-gray-100 text-gray-800',
        };
    }
}
