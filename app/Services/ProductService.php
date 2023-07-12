<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function createProduct($requestData)
    {
        $imagePath = $this->uploadProductImage($requestData->file('productImage'));

        $product = Product::create([
            'productSKU' => $requestData->input('productSKU'),
            'productName' => $requestData->input('productName'),
            'productPrice' => $requestData->input('productPrice'),
            'productWeight' => $requestData->input('productWeight'),
            'productCartDesc' => $requestData->input('productCartDesc'),
            'productLongDesc' => $requestData->input('productLongDesc'),
            'productImage' => $imagePath,
            'productStock' => $requestData->input('productStock'),
        ]);

        $category_id = $requestData->input('category_id');
        $category = Category::find($category_id);

        if ($category) {
            $product->categories()->attach($category);
        }

        return $product;
    }

    public function uploadProductImage($file)
    {
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('uploads', $file, $imageName);
        return $imageName;
    }

    public function updateProduct($product, $requestData)
    {
        $imagePath = $product->productImage;

        if ($requestData->hasFile('productImage')) {
            $imagePath = $this->uploadProductImage($requestData->file('productImage'));
        }

        $product->update([
            'productSKU' => $requestData->input('productSKU'),
            'productName' => $requestData->input('productName'),
            'productPrice' => $requestData->input('productPrice'),
            'productWeight' => $requestData->input('productWeight'),
            'productCartDesc' => $requestData->input('productCartDesc'),
            'productLongDesc' => $requestData->input('productLongDesc'),
            'productImage' => $imagePath,
            'productStock' => $requestData->input('productStock'),
        ]);

        $category_id = $requestData->input('category_id');
        $product->categories()->sync([$category_id]);

        return $product;
    }
}
