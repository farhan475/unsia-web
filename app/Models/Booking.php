<?php

namespace App\Models;

use Illuminate\Cache\HasCacheLock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'matkul_id',
        'studio_id',
        'topik',
        'tanggal_taping',
        'sesi',
        'status',
    ];
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

    //helper css
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'Pending'  => 'border-yellow-400 text-yellow-700 bg-yellow-50',
            'Approved' => 'border-blue-400 text-blue-700 bg-blue-50',
            'Taping'   => 'border-indigo-400 text-indigo-700 bg-indigo-50',
            'Editing'  => 'border-orange-400 text-orange-700 bg-orange-50',
            'Ready'    => 'border-green-400 text-green-700 bg-green-50',
            'Rejected' => 'border-red-400 text-red-700 bg-red-50',
            default    => 'border-gray-300 text-gray-600 bg-gray-50',
        };
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'Pending'   => 'bg-yellow-100 text-yellow-800',
            'Approved'  => 'bg-blue-50 text-[#00588a]',
            'Taping'    => 'bg-purple-100 text-purple-800',
            'Editing'   => 'bg-orange-100 text-orange-800',
            'Ready'     => 'bg-blue-100 text-blue-800',
            'Published' => 'bg-green-50 text-green-700',
            'Rejected'  => 'bg-red-100 text-red-800',
            default     => 'bg-gray-100 text-gray-800',
        };
    }
}
