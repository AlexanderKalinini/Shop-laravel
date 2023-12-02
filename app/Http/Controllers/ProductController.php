<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $product = Product::orderBy('count_estimates', 'desc')
            ->with('optionValues')
            ->with('properties')
            ->limit(4)
            ->get();
        return ProductResource::collection($product);
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

        $filteredProducts = Product::with('properties')
            ->with('optionValues')
            ->filter($objFilter);

        return  ProductResource::collection($filteredProducts
            ->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $product = Product::where('slug', $slug)
            ->with('properties')
            ->with('optionValues')
            ->with('descriptions')
            ->first();

        return new ProductResource($product);
    }

    public function showByIds(Request $request)
    {
        $data = $request->validate([
            'productsId' => ['']
        ]);

        return Product::whereIn('id', $data['productsId'])->limit(25)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
