<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_number',
        'shipment_date',
        'destination',
        'inventory_type',
        'product_id',
        'product_name',
        'quantity',
        'city',
        'armada',
        'status',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function trackingLogs()
    {
        return $this->hasMany(ShipmentTrackingLog::class);
    }
}
