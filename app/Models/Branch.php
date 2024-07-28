<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'address', 'phone', 'image', 'status'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
