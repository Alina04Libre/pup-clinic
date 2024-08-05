@if(session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

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
                <form method="POST" action='/userlogin/login'>
                    @csrf
                    <a class="logo-title fs-2 align-items-center fw-semibold text-decoration-none text-black" href="{{ url('/') }}">
                        <img src="assets/img/PUPLogo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
                        <label class="ms-1 d-inline-block">PUP Medical Clinic</label>
                    </a>

                    <div>
                        <h1>Student Module</h1>
                        <h2 class="fs-6">Sign in to start your session</h1>
                    </div>

                    <div class="form-group">
                        <label>Student Number</label>
                        <input type="text" class="form-control" data-inputmask="'mask': '9999-99999-**-9'" name="student_id" placeholder="0000-00000-BR-0" value={{old('student_id')}} />


                    </div>

                    <div>
                        <label>Birthday</label>
                        <div class="birthdate col">
                            <div class="select">
                                <select class="form-select" name="birth_month" value={{old('birth_month')}}>
                                    <option selected>Month</option>
                                    @for ($month = 1; $month <= 12; $month++) <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                        @endfor
                                </select>

                            </div>

                            <div class="select">
                                <select class="form-select" id="daySelect" name="birth_day" value={{old('birth_day')}}>
                                    <option selected>Day</option>

                                </select>

                            </div>

                            <div class="select">
                                <select class="form-select" id="yearSelect" name="birth_year" value={{old('birth_year')}}>
                                    <option selected>Year</option>
                                </select>

                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">

                    </div>
                    <!-- <div class="form-group">
                        <a href="#">Forgot Password?</a>
                    </div> -->
                    @error ('student_id')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                    @enderror
                    <button class="btn btn-primary" type="submit">Login</button>
                    <!-------------------------------------------------------------------Start of JS------------------------------------------------------------------>
                    <!--For Birthday-->
                    <script>
                        var select = document.getElementById("daySelect");

                        for (var i = 1; i <= 31; i++) {
                            var option = document.createElement("option");
                            option.value = i;
                            option.text = i;
                            select.appendChild(option);
                        }
                    </script>

                    <!--For BirthYear-->
                    <script>
                        var select = document.getElementById("yearSelect");

                        for (var i = 2013; i >= 1900; i--) {
                            var option = document.createElement("option");
                            option.value = i;
                            option.text = i;
                            select.appendChild(option);
                        }
                    </script>

                    <!--For the Student ID-->
                    <script>
                        $(document).ready(function() {
                            $('[data-inputmask]').inputmask();
                        });
                    </script>
                    <!-------------------------------------------------------------------End of JS------------------------------------------------------------------>

                </form>
            </div>
        </div>
    </div>
</body>

</html>