<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Pharmacy extends Model
{
    use HasFactory;

    protected $table = 'pharmacy';

    protected $fillable = [
        'name',
        'address'
    ];

    /**
     * Get all of the comments for the Pharmacy
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
