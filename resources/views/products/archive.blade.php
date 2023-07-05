@include('inc.navbar')
<div class="main-container">
    <h1>Archive Products</h1>
    <div class="row">
        </div>
            @if (session('success'))
                @include('partials._success')
            @elseif (session ('error'))
                @include('partials._error')
            @endif
            @if ($products->isEmpty())
                <br>
                <p style="font-weight: bold; font-size: 20px; text-align: center;" class="text-danger">No products are there in archive</p>
            @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product SKU</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Category</th>
                    <th>Product Weight</th>
                    <th>Product Cart Desc</th>
                    <th class="text-center">Product Long Desc</th>
                    <th>Product Image</th>
                    <th>Product Stock</th>
                    <th class="text-center" width="280px">Action</th>
                </tr>
            </thead>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->productSKU}}</td>
                    <td>{{$product->productName}}</td>
                    <td>{{$product->productPrice}}</td>
                    <td>
                        @foreach ($product->categories as $category)
                            <span>{{ $category->category_name }}</span>
                        @endforeach
                    </td>
                    <td>{{$product->productWeight}}</td>
                    <td>{{$product->productCartDesc}}</td>
                    <td>{{$product->productLongDesc}}</td>
                    <td class="text-center">
                        <img src="{{ asset('uploads/' . $product->productImage) }}" alt="Product Image" width="50">
                    </td>

                    <td>{{$product->productStock}}</td>
                    <td>
                      <div class="justify-content-center" style="display: flex; gap: 10px;">
                          <a href="{{ route('showProducts',$product->id) }}" type="button" class="btn btn-warning">Details</a>
                          <a href="{{ route('unarchiveProducts',$product->id) }}" type="button" class="btn btn-success">Unarchive</a>
                          <a href="{{ route('delarchiveProducts',$product->id) }}" type="button" class="btn btn-danger">Delete</a>  
                        </div>
                   </td>
                </tr>
            @endforeach
       </table>
       <centre>
       <div class="mt-4 d-flex justify-content-center">
            {{ $products->links('vendor.pagination.bootstrap') }}
            </div>
        </centre>
  </div>
  @endif