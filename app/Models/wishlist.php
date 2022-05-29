<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id' ,
        'name' ,
        'desc' ,
        'slug',
        'price',
        'sale_price',
        'product_img',
        'category_id'
    ];
}
