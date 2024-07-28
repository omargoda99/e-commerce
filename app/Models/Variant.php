<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 
        'product_type', 
        'count_box_inPacket', 
        'count_single_InBox', 
        'packet_cost_price', 
        'packet_sell_price', 
        'box_cost_price', 
        'box_sell_price', 
        'single_cost_price', 
        'single_sell_price', 
        'packet_stock', 
        'box_stock', 
        'single_stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
