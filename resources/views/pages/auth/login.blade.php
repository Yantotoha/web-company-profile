@include('includes.admin.style')
@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.admin.style')

</head>

<body class="bg-gradient-primary">


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="bg-white p-4 shadow rounded">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <h2 class="text-center mb-4">Login</h2>
                    <form method="POST" class="user" action="{{ route('login.auth') }}">
                        @csrf
                        <div class="form-group">
                            <label for="password" class="form-label">Username</label>
                            <input type="text" class="form-control form-control-user" name="username"
                                placeholder="Enter username" required />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-user" id="password" name="password"
                                name="password" placeholder="Password" required />
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="forgot-password.html" class="small">Forgot Password?</a><br>
                        <a href="register.html" class="small">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.admin.script')
        @if (session()->has('LoginError'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('LoginError') }}',
                });
            </script>
        @endif

</body>

</html>
