<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Products;

class CartItemController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('home')->with('error', 'Please log in to add items to your cart.');
        }
        // Retrieve all cart items with their associated products
        $cartItems = CartItem::with('product')->get();

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->subtotal;
        }

        // Calculate delivery cost (example: fixed value of 10,000)
        $deliveryCost = 10000;

        // Calculate total
        $total = $subtotal + $deliveryCost;

        return view('home.cart', compact('cartItems', 'subtotal', 'deliveryCost', 'total'));
    }


    public function addItem(Request $request)
    {
        // Memastikan pengguna telah login sebelum menambahkan produk
        if (!auth()->check()) {
            return redirect()->route('home')->with('error', 'Please log in to add items to your cart.');
        }

        $productId = $request->input('product_id');
        $userId = auth()->user()->id; // Mengambil ID pengguna yang terautentikasi

        // Cek apakah item sudah ada di keranjang pengguna
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Jika item sudah ada, update jumlahnya
            $cartItem->quantity += 1;
            $cartItem->subtotal = $cartItem->product->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            // Jika item belum ada, tambahkan ke keranjang pengguna
            $product = Products::find($productId);

            if ($product) {
                // Memastikan jumlah yang diminta tersedia di stok
                if ($product->stock <= 0) {
                    return redirect()->back()->with('error', 'Product is out of stock.');
                }

                $cartItem = new CartItem();
                $cartItem->user_id = $userId;
                $cartItem->product_id = $productId;
                $cartItem->quantity = 1;
                $cartItem->subtotal = $product->price;
                $cartItem->save();

                // Mengurangi stok produk
                $product->stock -= 1;
                $product->save();
            }
        }

        return redirect()->route('cart.index')->with('message', 'Item added to cart');
    }


    public function updateQuantity(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        // Temukan item keranjang
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found');
        }

        // Mengembalikan stok produk yang sebelumnya diambil
        $product = $cartItem->product;
        $product->stock += $cartItem->quantity;
        $product->save();

        // Update the quantity and subtotal
        $cartItem->quantity = $quantity;
        $cartItem->subtotal = $cartItem->product->price * $quantity;
        $cartItem->save();

        // Mengurangi stok produk yang baru diambil
        $product->stock -= $quantity;
        $product->save();

        // Calculate new subtotal and total
        $subtotal = $cartItem->subtotal;
        $deliveryCost = 10000; // Example: fixed delivery cost
        $total = $subtotal + $deliveryCost;

        return response()->json([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }


    public function removeItem($id)
    {
        // Temukan item keranjang
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found');
        }

        // Kembalikan stok produk
        $product = $cartItem->product;
        $product->stock += $cartItem->quantity;
        $product->save();

        // Hapus item dari keranjang
        $cartItem->delete();

        // Update subtotal in the cart items table
        $userId = auth()->user()->id;
        // CartItem::where('user_id', $userId)
        //     ->update([
        //         'subtotal' => DB::raw('quantity * (SELECT price FROM products WHERE products.id = cart_items.product_id)')
        //     ]);

        return redirect()->route('cart.index')->with('message', 'Item removed from cart');
    }

    public function clearCart()
    {
        // Delete all cart items
        CartItem::truncate();

        return redirect()->route('cart.index')->with('message', 'Cart cleared');
    }
}
