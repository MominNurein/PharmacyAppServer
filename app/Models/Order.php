<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' ,
        'cart_id' ,
        'address' ,
        'phone'
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'foreign_key', 'local_key');
    }
}
