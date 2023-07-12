<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Login Page</title>
</head>
<body>
    <section class="vh-100 mt-5">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    @if (session('success'))
                    @include('partials._success')
                    @elseif (session ('error'))
                    @include('partials._error')
                    @endif
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Reset your password</p>
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input name="userPassword" type="password" id="form3Example41" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                            <br>
                            <span class="text-danger">
                                @error('userPassword')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="form-outline mb-3">
                            <input name="cuserPassword" type="password" id="form3Example41" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                            <br>
                            <span class="text-danger">
                                @error('userPassword')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
</html>