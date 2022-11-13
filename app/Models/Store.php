<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends  Model
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'quantity_elements', 'address', 'status', 'qr',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function elements()
    {
        return $this->hasMany(Element::class);
    }
}
