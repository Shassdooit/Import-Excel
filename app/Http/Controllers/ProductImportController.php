<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Imports\ProductImport;
use App\Models\Product;;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    public function showImportForm(): View
    {
        return view('import-form');
    }

    public function import(Request $request): RedirectResponse
    {
        $file = $request->file('file');
        Excel::import(new ProductImport, $file);

        return redirect()->route('products.index');
    }

    public function showProducts(): View
    {
        $products = Product::paginate(9);
        return view('products.index', ['products' => ProductResource::collection($products)]);
    }

    public function showProduct(Product $product): View
    {
        $product->load('additionalFields', 'images');
        return view('products.show', ['product' => new ProductResource($product)]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        return redirect()->route('products.show', $product);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('products.show', $product);
    }
}
