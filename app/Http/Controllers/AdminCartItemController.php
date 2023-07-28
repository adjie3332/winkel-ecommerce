<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Support\Facades\Session;

class AdminCartItemController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu.');
            return redirect()->route('login');
        }

        // Memeriksa peran pengguna
        if (auth()->user()->role !== 'admin') {
            Session::flash('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->route('home');
        }
        // Mengambil daftar item keranjang dari database
        $cartItems = CartItem::with('product')->get();

        // Menampilkan halaman keranjang dengan data item keranjang
        return view('admin.cart.index', compact('cartItems'));
    }

    public function edit($id)
    {
        // Mengambil item keranjang dari database
        $cartItem = CartItem::findOrFail($id);

        // Menampilkan halaman edit dengan data item keranjang
        return view('admin.cart.edit', compact('cartItem'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        // Mengambil item keranjang dari database
        $cartItem = CartItem::findOrFail($id);

        // Menghitung perbedaan quantity sebelumnya dan quantity baru
        $oldQuantity = $cartItem->quantity;
        $newQuantity = $request->input('quantity');
        $quantityDifference = $newQuantity - $oldQuantity;

        // Mengupdate quantity pada item keranjang
        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        // Mengupdate total harga pada item keranjang
        $cartItem->subtotal = $cartItem->product->price * $newQuantity;
    $cartItem->save();

    // Mengupdate total harga pada produk terkait
    $product = Products::find($cartItem->product_id);
    $product->price -= $cartItem->product->price * $quantityDifference; // Kurangi harga produk dengan perbedaan total harga
    $product->save();

    // Redirect kembali ke halaman keranjang dengan pesan sukses
    return redirect()->route('carts.index')->with('success', 'Cart item updated successfully.');
}


    public function remove($id)
    {
        // Menghapus item keranjang dari database
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('carts.index')->with('success', 'Cart item removed successfully.');
    }
}
