<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    @include('cdn')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!-- Template Main JS File -->
    <script src="../js/main.js"></script>

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- -------------------- -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

</head>

<body>
    <div class="login-bg">
        <div class="login-form">
            <div class="containerform">
                <form method="POST" action="/facultylogin/login">
                    @csrf
                    <a class="logo-title fs-2 align-items-center fw-semibold text-decoration-none text-black" href="{{ url('/') }}">
                        <img src="assets/img/PUPLogo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
                        <label class="ms-1 d-inline-block">PUP Medical Clinic</label>
                    </a>
                    
                    <div>
                        <h1>Faculty Module</h1>
                        <h2 class="fs-6">Sign in to start your session</h1>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email address">
                    
                    </div>
                    
                
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                        <a href="#">Forgot Password?</a>
                    </div> -->
                    @error ('email')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                    @enderror
                    <button class="btn btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>