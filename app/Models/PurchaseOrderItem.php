<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $fillable = [
        'po_id',
        'product_id', // diganti dari item_id
        'quantity',
        'price',
        'sub_total',
    ];

    public function product() // diganti dari item()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'po_id');
    }
}
