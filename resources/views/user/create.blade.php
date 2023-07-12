<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Sign up page</title>
</head>
    <body>
    <section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
              @if(session('loginerror'))
                <div class="alert alert-success">
                    {{ session('loginerror') }}
                </div>
             @endif
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <!-- Form -->

                <form class="mx-1 mx-md-4" action="{{ route('storeUser') }}" method="POST">
                @csrf
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa-regular fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="username" name="usernames" class="form-control" />
                      <label class="form-label" for="username">Username</label>
                      <span class="text-danger">
                    @error('usernames')
                      {{$message}}
                      @enderror
                    </span>
                    
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="r-first-name" name="userFirstName" class="form-control" />
                      <label class="form-label" for="r-first-name">First Name</label>
                      <span class="text-danger">
                    @error('userFirstName')
                    {{$message}}
                      @enderror
                      </span>
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="r-last-name" name="userLastName" class="form-control" />
                      <label class="form-label" for="r-last-name">Last Name</label>
                      <span class="text-danger">
                    @error('userLastName')
                    {{$message}}
                      @enderror
                      </span>
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="phone" id="phone-number" name="userPhone" placeholder="e.g: +92321-8228183" class="form-control" />
                      <label class="form-label" for="phone-number">Phone Number</label>
                      <span class="text-danger">
                    @error('userPhone')
                    {{$message}}
                      @enderror
                      </span>
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="r-email" name="userEmail" placeholder="e.g: dani.q441@gmail.com" class="form-control" />
                      <label class="form-label" for="r-email">Your Email</label>
                      <span class="text-danger">
                    @error('userEmail')
                    {{$message}}
                      @enderror
                      </span>
                    </div>
                  </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="pw" name= "userPassword" class="form-control" />
                      <label class="form-label" for="pw">Password</label>
                      <span class="text-danger">
                      @error('userPassword')
                      {{$message}}
                        @enderror
                      </span>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="pwd"  class="form-control" />
                      <label class="form-label" for="pwd">Repeat your password</label>
                    </div>
                </div>
                
                <div class="form-radio d-flex me-5 justify-content-center mb-5">
                    <input class="gender me-2" type="radio" name="gender" value="male" id="male" />
                    <label class="form-radio-label me-4" for="form2Example3">
                      Male
                    </label>
                    <input class="gender me-2" type="radio" name="gender" value="female" id="female" />
                    <label class="form-radio-label" for="form2Example3">
                      Female
                    </label>
                    <span class="text-danger">
                      @error('gender')
                      {{$message}}
                      @enderror
                    </span>
                  </div>

                <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" name="check" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                    <span class="text-danger">
                      @error('check')
                      {{$message}}
                      @enderror
                    </span>
                </div>

                

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                  <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="{{ route('login') }}"
                      class="link-danger">Login</a></p>
                </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
</html>

