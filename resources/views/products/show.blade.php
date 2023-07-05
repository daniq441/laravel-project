@include('inc.navbar')
  <!-- Main Content -->
  <div class="main-container">
  <h1>Description of the product</h1>
  <br>
  <div>
    <label for=""><h5>Product's Image:</h5></label> <img src="{{ asset('uploads/' . $product->productImage) }}" alt="Product Image" width="100"><br>
    <label for=""><h5>Product's SKU:</h5></label> {{$product->productSKU}}<br>
    <label for=""><h5>Product's Name:</h5></label> {{$product->productName}}<br>
    <label for=""><h5>Product's Category:</h5></label> {{$product->categories->first()->category_name}}<br>
    <label for=""><h5>Product's Price:</h5></label> {{$product->productPrice}}<br>
    <label for=""><h5>Product's Weight:</h5></label> {{$product->productWeight}}<br>
    <label for=""><h5>Product's Cart Desc:</h5></label> {{$product->productCartDesc}}<br>
    <label for=""><h5>Product's Long Desc:</h5></label> {{$product->productLongDesc}}<br>
    <label for=""><h5>Product's Stock:</h5></label> {{$product->productStock}}<br>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
