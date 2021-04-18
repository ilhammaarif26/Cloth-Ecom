<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function banners()
    {
        $getBanner = Banner::where('status', 1)->get()->toArray();
        return $getBanner;
    }
}