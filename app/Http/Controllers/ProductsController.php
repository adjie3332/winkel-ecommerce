<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $products = Products::all();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|max:2048', // Validate the image file if present
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = hash('sha256', time()) . '.' . $image->extension();
            $imagePath = $image->storeAs('public/images', $imageName);
            $validatedData['image'] = $imageName;
        }

        Products::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Products::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|max:2048', // Validate the image file if present
        ]);

        $product = Products::findOrFail($id);

        $product->category_id = $validatedData['category_id'];
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the previous image
            Storage::delete('public/images/' . $product->image);

            $image = $request->file('image');
            $imageName = hash('sha256', time()) . '.' . $image->extension();
            $imagePath = $image->storeAs('public/images', $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $product = Products::findOrFail($id);

    // Delete the image file if exists
    if ($product->image) {
        Storage::delete('public/images/' . $product->image);
    }

    $product->delete();

    // Delete the image directory if exists
    $directory = 'public/images/' . $id;
    Storage::deleteDirectory($directory);

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

}
