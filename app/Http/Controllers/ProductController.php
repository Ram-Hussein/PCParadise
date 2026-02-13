<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSpec;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('product.products', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $similarProducts = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->take(4)
                                    ->get();
        $specs = ProductSpec::where('product_id', $product->id)->get();
        return view('product.product_details', [
            'product' => $product,
            'similarProducts' => $similarProducts,
            'specs' => $specs,
        ]);
        }
}
