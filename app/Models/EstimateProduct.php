<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimate_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'description',
        'tax_id',
    ];

    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }


}
