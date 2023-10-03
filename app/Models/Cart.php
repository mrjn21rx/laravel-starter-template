<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_id',
        'seller_id',
        'qty',
        'price',
    ];

    /**
     * Belongs to Relationship model with product model
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
