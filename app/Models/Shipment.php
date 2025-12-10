<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'sender_name',
        'sender_address',
        'receiver_name',
        'receiver_address',
        'weight',
        'description',
        'status',
    ];

    public function history()
    {
        return $this->hasMany(ShipmentHistory::class);
    }
}
