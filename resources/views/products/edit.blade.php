@include('inc.navbar')
<div class="main-container">
  <div class="container">
    <h2>Product Form</h2>
    <form action="{{ route('updateProducts',$currentProduct->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="form-group">
        <label for="sku">Product SKU:</label>
        <input type="text" class="form-control" id="sku" value="{{$currentProduct->productSKU}}" name="productSKU" required>
      </div>
      <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" class="form-control" id="name" value="{{$currentProduct->productName}}" name="productName" required>
      </div>
      <div class="form-group">
          <label for="category">Product Category:</label>
          <select class="form-control" id="category" name="category_id" required>
                  <option value="{{$currentProduct->categories->first()->id}}">{{$currentProduct->categories->first()->category_name}}</option>
              @foreach($categories as $category)
                  <option value="{{ $category->id }}">
                      {{ $category->category_name }}
                  </option>
              @endforeach
          </select>
      </div>

      
      <div class="form-group">
        <label for="price">Product Price:</label>
        <input type="number" class="form-control" id="price" value="{{$currentProduct->productPrice}}"name="productPrice" required>
      </div>
      <div class="form-group">
        <label for="weight">Product Weight:</label>
        <input type="text" class="form-control" id="weight" value="{{$currentProduct->productWeight}}" name="productWeight" required>
      </div>
      <div class="form-group">
        <label for="cart-desc">Product Cart Description:</label>
        <input class="form-control" id="cart-desc" value="{{$currentProduct->productCartDesc}}" name="productCartDesc" required></input>
      </div>
      <div class="form-group">
        <label for="long-desc">Product Long Description:</label>
        <input class="form-control" id="long-desc" value="{{$currentProduct->productLongDesc}}" name="productLongDesc" required></input>
      </div>
      <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" class="form-control-file" id="image" value="{{ $currentProduct->productImage }}" name="productImage">
      </div>
      <div class="form-group">
        <label for="stock">Product Stock:</label>
        <input type="number" class="form-control" id="stock"  value="{{$currentProduct->productStock}}" name="productStock" required>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear All</button>
    </form>
  </div>
  <script>
    function clearForm() {
      document.getElementById("sku").value = "";
      document.getElementById("name").value = "";
      document.getElementById("price").value = "";
      document.getElementById("weight").value = "";
      document.getElementById("cart-desc").value = "";
      document.getElementById("long-desc").value = "";
      document.getElementById("image").value = "";
      document.getElementById("stock").value = "";
    }
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </div>
