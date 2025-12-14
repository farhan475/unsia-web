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
        'tanggal_taping' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    //helper untuk css
    public function getStatusBadgeAtribut()
    {
        return match ($this->status) {
            'Pending'   => 'bg-yellow-100 text-yellow-800',
            'Approved'  => 'bg-[#00588a]/10 text-[#00588a]', // Biru Transparan
            'Taping'    => 'bg-purple-100 text-purple-800',
            'Editing'   => 'bg-orange-100 text-orange-800',
            'Published' => 'bg-green-100 text-green-800',
            'Rejected'  => 'bg-red-100 text-red-800',
            default     => 'bg-gray-100 text-gray-800',
        };
    }
}
