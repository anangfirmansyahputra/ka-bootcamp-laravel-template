<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'variant_name',
        'color',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
