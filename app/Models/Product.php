<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pharmacy;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'price' ,
        'qty' ,
        'pharmacy_id',
        'image'
    ];

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
