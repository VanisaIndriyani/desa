<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'kapasitas',
        'gambar_url',
        'gambar_path',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(FacilityBooking::class);
    }
}
