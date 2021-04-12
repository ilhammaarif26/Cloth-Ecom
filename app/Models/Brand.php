<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // relation to many table product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}