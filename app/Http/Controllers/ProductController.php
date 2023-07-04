<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('archive',0)->paginate(5);
        // dd($products);
        return view('products.dashboard', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
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
    
        Product::create([
            'productSKU' => $request->input('productSKU'),
            'productName' => $request->input('productName'),
            'productPrice' => $request->input('productPrice'),
            'productWeight' => $request->input('productWeight'),
            'productCartDesc' => $request->input('productCartDesc'),
            'productLongDesc' => $request->input('productLongDesc'),
            'productImage' => $imageName, 
            'productStock' => $request->input('productStock'),
        ]);
    
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
        return view('products.edit', compact('product'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('archive', 0)
            ->where(function ($query) use ($search) {
                $query->where('productSKU', 'LIKE', "%$search%")
                    ->orWhere('productName', 'LIKE', "%$search%");
            })
            ->paginate(5);
        return view('products.dashboard', compact('products'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'productSKU' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productWeight' => 'required',
            'productCartDesc' => 'required',
            'productLongDesc' => 'required',
            'productImage' => 'nullable|image', // Allow the field to be nullable (optional) when updating
            'productStock' => 'required',
        ]);
    
        // Handle image update
        if ($request->hasFile('productImage')) {
            $image = $request->file('productImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
        } else {
            $imageName = $product->productImage; // Keep the existing image if no new image is uploaded
        }
    
        $product->update([
            'productSKU' => $request->input('productSKU'),
            'productName' => $request->input('productName'),
            'productPrice' => $request->input('productPrice'),
            'productWeight' => $request->input('productWeight'),
            'productCartDesc' => $request->input('productCartDesc'),
            'productLongDesc' => $request->input('productLongDesc'),
            'productImage' => $imageName, // Save the updated image file name in the database
            'productStock' => $request->input('productStock'),
        ]);
    
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
}
