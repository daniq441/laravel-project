@include('inc.navbar')
<div class="main-container">
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
                    <br>
                    <hr>
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Change Password</p>
                    <form action="{{ route('resetPassword') }}" method="POST">
                        @csrf
                        <!-- Old Password input -->
                        <div class="form-outline mb-3">
                            <input name="oldPassword" type="password" id="form3Example5" class="form-control form-control-lg"
                            placeholder="Enter old password" />
                            <label class="form-label" for="form3Example5">Old Password</label>
                        </div>
                        <!-- New Password input -->
                        <div class="form-outline mb-3">
                            <input name="newPassword" type="password" id="form3Example6" class="form-control form-control-lg"
                            placeholder="Enter new password" />
                            <label class="form-label" for="form3Example6">New Password</label>
                        </div>
                        <!-- Confirm Password input -->
                        <div class="form-outline mb-3">
                            <input name="confirmPassword" type="password" id="form3Example7" class="form-control form-control-lg"
                            placeholder="Re-enter new password" />
                            <label class="form-label" for="form3Example7">Re-enter New Password</label>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
    var dropdownTrigger = document.getElementById("accountDropdown");
    new bootstrap.Dropdown(dropdownTrigger);
  });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            var dropdownTrigger = document.getElementById("accountDropdown");
            new bootstrap.Dropdown(dropdownTrigger);
        });
    </script> -->
</div>