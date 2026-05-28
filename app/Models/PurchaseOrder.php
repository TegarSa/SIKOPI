<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id',
        'user_id',
        'po_number',
        'po_date',
        'status',
        'total_price',
    ];

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'po_id');
    }
}
