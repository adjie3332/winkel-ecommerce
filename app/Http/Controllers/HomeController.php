<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use App\Models\CartItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Products::all();

        $cartItems = CartItem::all();
        $cartTotalQuantity = $cartItems->sum('quantity');

        // Mengambil nilai kategori yang dipilih dari request
        $productFilter = $request->input('category', 'all');

        return view('home.index', compact('categories', 'products', 'productFilter', 'cartTotalQuantity'));
    }
}
