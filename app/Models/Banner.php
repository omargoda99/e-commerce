<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'discount', 
        'btnText', 'btnURL', 'isHome', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
