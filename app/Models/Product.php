<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    function ProductGallery(){
        return $this->hasMany(ProductGallery::class, 'product_id');
    }

    function Cart(){
        return $this->hasMany(Cart::class, 'cart_id');
    }

    function attribute(){
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

}
