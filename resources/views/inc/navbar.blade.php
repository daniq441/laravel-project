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
      background: linear-gradient(to right, #1e3c72, #2a5298);
      color: #fff;
      height: 10vh;
      position: relative;
      z-index: 1;
    }
    .navbar-left {
      background: linear-gradient(to bottom, #8fbc8f, #98fb98);
      color: #000;
      height: 100vh;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      width: 225px;
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
    .navbar-nav .nav-link {
      color: #fff;
    }
    .navbar-nav .nav-link:hover {
      color: #d1d1d1;
    }
    .navbar-left .nav-link {
      color: #000;
    }
    .navbar-left .nav-link:hover {
      color: #666;
    }
    .custom-btn {
      display: inline-block;
      padding: 10px 20px;
      margin: 5px;
      border-radius: 5px;
      background-color: #4caf50;
      color: #fff;
      text-decoration: none;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      transition: box-shadow 0.3s ease;
    }
    .custom-btn:hover {
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
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
          <a href="{{ route('logout') }}" type="button" class="btn btn-outline-light">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Left Navbar -->
  <nav class="navbar navbar-left">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('products') }}">
          <button class="custom-btn btn-block">Products</button>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <button class="custom-btn btn-block">Edit Products</button>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('archiveProducts') }}">
          <button class="custom-btn btn-block">Archive Products</button>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('orderDetails') }}">
          <button class="custom-btn btn-block">Order Details</button>
        </a>
      </li>
    </ul>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
