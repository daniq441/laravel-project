<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
  <button class="navbar-brand mb-0 h1 bg-light" style="background: none; border: none;">
  <i class="fas fa-shopping-cart">Ecommerce</i>
</button>
  <div class="dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-user"></i> Account
  </a>
  <ul class="dropdown-menu" aria-labelledby="accountDropdown">
    <li><a class="dropdown-item" href="{{ route('changePassword') }}">Change Password</a></li>
    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
  </ul>
</div>
</div>
</nav>

  <!-- Left Navbar -->
  <nav class="navbar navbar-left">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('welcome') }}">
          <button class="custom-btn btn-block">User Dashboard</button>
        </a>
      </li>
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
