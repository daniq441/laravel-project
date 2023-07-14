<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

class ProductService{
    
    // fucntions to be defined !
    public function index()
    {
        $product = new Product();
        $products = $product->getProductsForDashboard();
        return view('products.dashboard', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store($request)
    {
        $request->validate([
            'productSKU' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productWeight' => 'required',
            'productCartDesc' => 'required',
            'productLongDesc' => 'required',
            'productImage' => 'required|image',
            'productStock' => 'required',
        ]);
    
        // Handle image upload
        if ($request->hasFile('productImage')) {
            $image = $request->file('productImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
        } else {
            return redirect()->back()->with('error', 'Image upload failed!');
        }
    
        $product = Product::create([
            'productSKU' => $request->input('productSKU'),
            'productName' => $request->input('productName'),
            'productPrice' => $request->input('productPrice'),
            'productWeight' => $request->input('productWeight'),
            'productCartDesc' => $request->input('productCartDesc'),
            'productLongDesc' => $request->input('productLongDesc'),
            'productImage' => $imageName, 
            'productStock' => $request->input('productStock'),
        ]);
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);

        if ($category) {
            $product->categories()->attach($category);
        }
    
        return redirect()->route('products')->with('success', 'Inserted successfully!');
    }

    public function show($product)
    {
        return view('products.show', compact('product'));
    }

    public function search($request)
    {
        $search = $request->input('search');
        $product = new Product();
        $products = $product->searchProducts($search);
        return view('products.dashboard', compact('products'));
    }

    public function edit($id)
    {
        // dd($id);
        // dd($product);
        $product = new Product();
        $currentProduct = $product->getCurrentCategory($id);
        // dd($currentProduct);
        $categories = Category::all();
        return view('products.edit', compact('currentProduct', 'categories'));
    }

    public function reset(){
        return redirect()->route('products');
    }

    public function update($request, $product)
    {
    // dd($request->productImage);
    $request->validate([
        'productSKU' => 'required',
        'productName' => 'required',
        'productPrice' => 'required',
        'productWeight' => 'required',
        'productCartDesc' => 'required',
        'productLongDesc' => 'required',
        'category_id' => 'required|exists:categories,id', // Validate the category ID
        'productImage' => 'nullable|image',
        'productStock' => 'required',
    ]);

    // Handle image update
    if ($request->hasFile('productImage')) {
        // dd('okk');
        $image = $request->file('productImage');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
    } else {
        // dd('ok');
        $imageName = $product->productImage; // Keep the existing image if no new image is uploaded
    }
    // dd($imageName);

    $product->update([
        'productSKU' => $request->input('productSKU'),
        'productName' => $request->input('productName'),
        'productPrice' => $request->input('productPrice'),
        'productWeight' => $request->input('productWeight'),
        'productCartDesc' => $request->input('productCartDesc'),
        'productLongDesc' => $request->input('productLongDesc'),
        'productImage' => $imageName,
        'productStock' => $request->input('productStock'),
    ]);

    $category_id = $request->input('category_id');
    $product->categories()->sync([$category_id]);

    return redirect()->route('products')->with('success', 'Data updated successfully!');
    }

    public function archive($product)
    {
        $products = $product->getArchivedProducts();
        return view('products.archive', compact('products'));
    }

    public function unarchive($product)
    {
        $product->unarchiveProduct();
        return redirect()->route('archiveProducts')->with('success', 'Product Unarchived successfully!');
    }

    public function destroy($product)
    {
        $product->archiveProduct();
        return redirect()->route('products')->with('success', 'Product Archived successfully!');
    }

    public function delete($product)
    {
        $product->deleteProduct();
        return redirect()->route('archiveProducts')->with('success', 'Product deleted successfully!');
    }
}