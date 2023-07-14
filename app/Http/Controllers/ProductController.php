<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return $this->getProductService()->index();
    }

    public function create()
    {
        return $this->getProductService()->create();
    }

    public function store(Request $request)
    {
        return $this->getProductService()->store($request);
    }
    
    public function show(Product $product)
    {
        return $this->getProductService()->show($product);
    }

    public function search(Request $request)
    {
        return $this->getProductService()->search($request);
    }

    public function reset(){
        return $this->getProductService()->reset();
    }

    public function edit($id)
    {
        return $this->getProductService()->edit($id);
    }

    public function update(Request $request, Product $product)
    {
    return $this->getProductService()->update($request, $product);
    }

    // 
    public function archive(Product $product)
    {
        return $this->getProductService()->archive($product);
    }

    public function unarchive(Product $product)
    {
        return $this->getProductService()->unarchive($product);
    }

    public function destroy(Product $product)
    {
        return $this->getProductService()->destroy($product);
    }

    public function delete(Product $product)
    {
        return $this->getProductService()->delete($product);
    }
}
