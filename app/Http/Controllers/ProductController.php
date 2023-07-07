<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::with('categories')->where('archive', 0)->paginate(5);
        $products = Product::with('categories')->where('archive', 0)->paginate(5);
        return view('products.dashboard', compact('products'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // dd($id);
        // dd($product);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::search($search)->paginate(5);
        // dd($products);
        return view('products.dashboard', compact('products'));
    }

    public function reset(){
        return redirect()->route('products');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
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

    // Update the product category
    $category_id = $request->input('category_id');
    $product->categories()->sync([$category_id]);

    return redirect()->route('products')->with('success', 'Data updated successfully!');
}

    // 
    public function archive(Product $product)
    {
        $products = Product::where('archive',1)->paginate(5);
        // dd($products);
        return view('products.archive', compact('products'));
    }

    public function unarchive(Product $product)
    {
        $product->archive = 0; // Set the archive column to 1
        $product->save(); // Persist the changes
    
        return redirect()->route('archiveProducts')->with('success', 'Product Unarchived successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->archive = 1; // Set the archive column to 1
        $product->save(); // Persist the changes
    
        return redirect()->route('products')->with('success', 'Product Archived successfully!');
    }

    public function delete(Product $product)
    {
        $product->categories()->detach(); // Remove the related categories first
        $product->delete(); // Delete the product
        return redirect()->route('archiveProducts')->with('success', 'Product deleted successfully!');
    }
}
