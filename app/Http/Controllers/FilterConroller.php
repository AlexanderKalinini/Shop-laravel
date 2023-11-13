<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterConroller extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy("title")->get();
        $categories = Category::orderBy("title")->get();

        $maxPrice = Product::max("price");
        $minPrice = Product::min("price");

        return [
            "brands" => $brands,
            "categories" => $categories,
            "maxPrice" => $maxPrice,
            "minPrice" => $minPrice
        ];
    }
}
