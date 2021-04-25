<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // relasi one to many ke sub category
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    // relase many to one ke table section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'name');
    }

    // relasi one to many ke parent category
    public function parentcategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'category_name');
    }

    // for listing category
    public static function catDetails($url)
    {
        $catDetails = Category::select('id', 'parent_id', 'category_name', 'url', 'description')->with(['subcategories' => function ($query) {
            $query->select('id', 'parent_id', 'category_name', 'url', 'description')->where('status', 1);
        }])->where('url', $url)->first()->toArray();

        if ($catDetails['parent_id'] == 0) {
            // only show main category in breadcumb
            $breadcrumbs = '<a href="' . url($catDetails['url']) . '">' . $catDetails['category_name'] . '</a>';
        } else {
            // show main and subcategory in breadcrumbs
            $parentCategory = Category::select('category_name', 'url')->where('id', $catDetails['parent_id'])
                ->first()->toArray();
            $breadcrumbs = '<a href="' . url($parentCategory['url']) . '">' . $parentCategory['category_name'] . '</a>
            &gt;  <a href="' . url($catDetails['url']) . '">' . $catDetails['category_name'] . '</a>';
        }

        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach ($catDetails['subcategories'] as $key => $subcat) {
            $catIds[] = $subcat['id'];
        }

        return array('catIds' => $catIds, 'catDetails' => $catDetails, 'breadcrumbs' => $breadcrumbs);
    }
}
