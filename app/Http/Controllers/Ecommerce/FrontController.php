<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();

        return view('costumer.index', compact('products'));
    }

    public function product()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();

        return view('costumer.produk', compact('products'));
    }

    public function full_custom()
    {
        return view('costumer.full_custom');
    }

    public function categoryProduct($slug)
    {
        $products = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->get();

        return view('costumer.produk', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['category'])->where('slug', $slug)->first();
        $cart = Cart::where('product_id', $product->id)->first();

        return view('costumer.show', compact('product', 'cart'));
    }

}
