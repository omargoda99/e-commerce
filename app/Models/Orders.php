<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'currency',
        'shipping_method',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
