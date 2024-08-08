<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportFileRequest;
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


    public function import(ImportFileRequest $request): RedirectResponse
    {
        // todo перенести в очереди, чтобы не блокировать интерфейс
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
}
