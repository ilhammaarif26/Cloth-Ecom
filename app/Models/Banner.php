<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function banners()
    {
        $getBanner = Banner::where('status', 1)->get();
        $getBanner = json_decode(json_encode($getBanner), true);
        return $getBanner;
    }
}