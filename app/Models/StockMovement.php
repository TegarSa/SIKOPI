<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $table = 'stock_movements';

    protected $fillable = [
        'product_id',
        'movement_type',   // IN / OUT
        'reference_type',  // PO / SHIPMENT / ADJUSTMENT
        'reference_id',
        'quantity',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function scopeIn($query)
    {
        return $query->where('movement_type', 'IN');
    }

    public function scopeOut($query)
    {
        return $query->where('movement_type', 'OUT');
    }
}
