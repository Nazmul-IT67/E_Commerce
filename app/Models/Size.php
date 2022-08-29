<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    function attribute(){
        return $this->hasMany(ProductAttribute::class, 'size_id');
    }
}
