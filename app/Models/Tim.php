<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory;
    protected $table = 'tim';

    public function Koordinator()
    {
        return $this->belongsTo(User::class, 'koordinator_id', 'id');
    }
    public function Area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
