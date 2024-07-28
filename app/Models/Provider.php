<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'password',
        'status',
        'gender',
        'wallet',
        'points',
    ];


    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }
}
