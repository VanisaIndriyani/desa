<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'unit',
        'nilai',
        'urut',
        'published',
    ];
}
