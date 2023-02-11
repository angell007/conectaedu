<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'reference',  'status', 'qr',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getStatusAttribute()
    {
        if ($this->attributes['status'] == 1) return 'activo';
        return 'inactivo';
    }
}
