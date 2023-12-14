<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\OptionValue;
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
        $options = OptionValue::with('option')->get();

        $options = $options->mapToGroups(function (OptionValue $item) {
            return [$item->option->title => $item->value];
        });

        return [
            "brands" => $brands,
            "categories" => $categories,
            "maxPrice" => $maxPrice,
            "minPrice" => $minPrice,
            "options" => $options,
        ];
    }
}