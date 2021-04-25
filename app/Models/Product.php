<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // relation many to one category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // relation many to one section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // relations to brand table
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // realtion one to many attributes
    public function attributes()
    {
        return $this->hasMany(ProductsAttribute::class);
    }

    // relation to many images
    public function images()
    {
        return $this->hasMany(ProductsImage::class);
    }

    public static function productFilters()
    {
        // Product Filter
        $productFilters['fabricArray'] = array('Cotton', 'Polyester', 'Woll');
        $productFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveles');
        $productFilters['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $productFilters['fitArray'] = array('Regular', 'Slim');
        $productFilters['occassionArray'] = array('Casual', 'Formal');

        return $productFilters;
    }

}

