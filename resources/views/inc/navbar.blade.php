<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Creating products</title>
  <style>
    .main-container {
      padding: 20px;
      padding-left: 250px;
    }
    .navbar-main {
      background-color: #C0C0C0;
      color: #fff;
      height: 10vh;
    }
    .navbar-left {
      background-color: #8fbc8f;
      color: #fff;
      height: 100vh;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      width: 200px;
      padding: 20px;
    }
    #btlogout {
      padding-left: 100px;
    }
    .navbar-horizontal {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>
<body>
  <!-- Horizontal Navbar -->
  <nav class="navbar navbar-main">
    <div class="container">
      <span class="navbar-brand mb-0 h1">Ecommerce</span>
      <ul class="navbar-nav ml-auto">
        <li id="btlogout" class="nav-item">
        <a href="{{ route('logout') }}" type="button" class="btn btn-secondary">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Left Navbar -->
  <nav class="navbar navbar-left">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('products') }}">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Edit Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('archiveProducts') }}">Archive Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('orderDetails') }}">Order Details</a>
      </li>
    </ul>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
