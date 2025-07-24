<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('costumer');
    }

    public function index()
    {
        $products = Product::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(4);

        return view('costumer.index', compact('products'));
    }

    public function product()
    {
        $products = Product::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('costumer.produk', compact('products'));
    }

    public function full_custom()
    {
        $products = Product::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(4);

        return view('costumer.full_custom', compact('products'));
    }

    public function cari(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('status', 1)
            ->where('name', 'like', '%'.$search.'%')
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('costumer.produk', compact('products'));
    }

    public function categoryProduct($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $products = $category->product()
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('costumer.produk', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['category'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        $cart = Cart::where('product_id', $product->id ?? null)->first();

        return view('costumer.show', compact('product', 'cart'));
    }
}
