<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;



class BrandController
{
    public function show()
    {
        if (Cache::has("brands")) {
            return Cache::get("brands");
        }

        $brands = Brand::where('on_homepage', true)->limit(6)->get();
        Cache::put("brands", $brands, 60);
        return $brands;
    }
}
