<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'integer',
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'timestamp',
        // 'title' => 'array'
    ];

    public function scopeActive($query)
    {
        return $query->where('data', 1000);
    }
}
