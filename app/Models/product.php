<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        //
        'name',
        'desc',
        'slug',
        'price',
        'sale_price',
        'product_img',
        'status',
        'category_id'
    ];


}
