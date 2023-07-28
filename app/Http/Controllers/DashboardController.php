<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Products;
use App\Models\Category;
use App\Models\Chekcout;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hitung jumlah pengguna
        $users = User::count();

        // Hitung jumlah produk
        $products = Products::count();

        // Hitung jumlah kategori
        $categories = Category::count();

        $orders = Chekcout::count();

        // Memeriksa status autentikasi pengguna
        if (!auth()->check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu.');
            return redirect()->route('login');
        }

        // Memeriksa peran pengguna
        if (auth()->user()->role !== 'admin') {
            Session::flash('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->route('home');
        }

        return view('admin.dashboard', compact('users', 'products', 'categories', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
