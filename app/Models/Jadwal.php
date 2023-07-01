<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $casts = [
        'hari' => 'array'
    ];

    public function Admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
    public function Tim()
    {
        return $this->belongsTo(Tim::class, 'tim_id', 'id');
    }
}
