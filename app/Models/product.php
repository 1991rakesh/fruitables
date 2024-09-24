<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'mrp_price',
        'selling_price',
        'short_description',
        'long_description',
        'category',
        'tags',
        'vendor_id'
    ];

    public function images(){
        return $this->hasMany(Image::class, 'product_id', 'id');
    }
}
