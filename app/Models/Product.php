<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_type', 
        'name', 
        'barcode'
    ];
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
