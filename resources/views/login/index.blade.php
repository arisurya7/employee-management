<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Custom fonts for this template-->
   <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
   <link
       href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
       rel="stylesheet">

   <!-- Custom styles for this template-->
   <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @push('styles')
    <link href="{{ asset('sb-admin/css/login-style.css') }}" rel="stylesheet">
    @endpush

    @stack('styles')
    <title> Login</title>
</head>

<body style="background-color: rgb(252, 252, 252);">

    <div class="container mt-1">
        <div class="row justify-content-center mt-5 ml-5 mr-5">            
        </div>
        <div class="row justify-content-center">
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="wrap d-md-flex">
                                <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last"
                                    style="background:linear-gradient(0deg, rgba(25, 98, 255, 0.6), rgba(28, 124, 250, 0.6)), url({{ asset('img/bg-2.jpg') }});  background-size:cover;">
                                    <div class="text">
                                        <h2>Kelola Data Pegawai Anda</h2>
                                        <p>Login akun</p>
                                    </div>
                                </div>
                                <div class="login-wrap p-4 p-lg-5">
                                    <div class="d-flex">
                                        <div class="w-100">
                                            <h3 class="mb-4">Employee Management</h3>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @if (session()->has('loginError'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            {{session('loginError')}}
                                        </div>
                                        @endif
                                        @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            {{session('success')}}
                                        </div>
                                        @endif
                                    </div>
                                    <form action="#" class="signin-form" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="label" for="name">Username</label>
                                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="label" for="password">Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" onclick="showPass()"> Show Password
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="form-control btn submit px-3"
                                                style="background-color: #0d6efd; color:white;">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>


   
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function showPass() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
    
</body>

</html>
