<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show()
    {

        if (Cache::has('categories')) {
            return Cache::get('categories');
        }

        $categories = Category::all();
        Cache::put('categories', $categories, 600);
        return $categories;
    }
}
