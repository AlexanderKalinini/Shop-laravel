<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return Product::orderBy('count_estimates', 'desc')->limit(9)->get();
    }



    public function showPaginate(ProductRequest $request)
    {

        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 25;

        $objFilter = app()->make(
            ProductFilter::class,
            ['queryParams' => array_filter($data)]
        );

        $filteredProducts = Product::filter($objFilter);

        // if ($data["sort"] === 'title') {
        //     return $filteredProducts->orderBy('title')->paginate($perPage, ['*'], 'page', $page);
        // }
        // if ($data["sort"] === 'cheap') {
        //     return $filteredProducts->orderBy('price',)->paginate($perPage, ['*'], 'page', $data['page']);
        // }
        // if ($data["sort"] === 'expensive') {
        //     return $filteredProducts->orderBy('price', 'desc')->paginate($perPage, ['*'], 'page', $data['page']);
        // }

        return $filteredProducts->paginate($perPage, ['*'], 'page', $data['page']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
