<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'category_name'
    ];

    function subcategory(){
        return $this->hasOne(SubCategory::class);
    }

    function product(){
        return $this->hasMany(Product::class, 'category_id');
    }
}
