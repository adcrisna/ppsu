<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';

    public function Admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
