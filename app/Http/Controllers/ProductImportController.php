<?php

namespace App\Http\Controllers;

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
        return view('products.index', compact('products'));
    }

    public function showProduct(Product $product): View
    {
        return view('products.show', compact('product'));
    }
}
