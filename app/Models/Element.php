<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'reference', 'quantity', 'status', 'store_id', 'qr',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
