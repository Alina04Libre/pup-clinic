<!-- ======= Navbar Section ======= -->
<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-scroll">
        <div class="container">
            @if (Route::has('userlogin')) <!--If the system is logged in to the account-->
                @auth
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/userdashboard') }}">
                        <img src="assets/img/PUPLogo.png" alt="Logo" width="40" height="40"
                            class="d-inline-block align-text-top">
                        <div class="d-block ms-2 lh-1">
                            <span>PUP-Medical Clinic</span>
                            <br>
                            <small class="text-muted" style="font-size: 12px;">STA. MESA</small>
                        </div>
                    </a>
                @else <!--If the user is only a guest-->
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <img src="assets/img/PUPLogo.png" alt="Logo" width="40" height="40"
                            class="d-inline-block align-text-top">
                        <div class="d-block ms-2 lh-1">
                            <span>PUP-Medical Clinic</span>
                            <br>
                            <small class="text-muted" style="font-size: 12px;">STA. MESA</small>
                        </div>
                    </a>
                @endauth
            @endif


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    @if (Route::has('userlogin')) <!--If the system is logged in to the account-->
                        @auth
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/userdashboard') }}">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/') }}">Home</a>
                            </li>
                        @endauth
                    @endif

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/aboutUs') }}">About Us</a>
                    </li>

                    @guest
                    <script>
                        var botmanWidget = {
                            title: 'PUP Chatbot',
                            aboutText: 'Start the conversation by asking a question',
                            introMessage: 'Hello how can I help you?',
                            mainColor: '#c02026',
                            bubbleBackground: '#c02026',
                            headerTextColor: '#fff',
                            displayMessageTime: true,
                            bubbleAvatarUrl: '',
                        };
                    </script>
                    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
                    @endguest

                    @if (Route::has('userlogin')) <!--If the system is logged in to the account-->
                        @auth
                            <!-- The authenticated user navigation items here -->
                            <li class="nav-item">
                                <a class="nav-link active" href="{{url('/appoint')}}">Appointment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{url('/viewAnnouncements')}}">Announcement</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{url('/onlineConsultation')}}">Open Consultation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{url('/frequentlyaskQuestions')}}">FAQ's</a>
                            </li>
                        @endauth
                    @endif
                </ul>

                @if (Auth::check())
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (Auth::user()->profile_photo_path)
                                    <img src="{{ asset('uploads/' . Auth::user()->profile_photo_path) }}" alt="User Avatar"
                                        class="rounded-circle" width="40">
                                @else
                                    <div class="initials-profile rounded-circle" id="randomAvatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                                    </div>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!-- Dropdown menu items here -->
                                <a class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="{{ route('user_view_medical_record') }}">Medical Record</a>
                                <!-- Other dropdown menu items -->
                                <hr class="dropdown-divider">
                                <form class="d-flex" action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Sign out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                @else
                    <!-- If the user is a guest, show the login button -->
                    <form class="d-flex">
                        <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Login</button>
                        &nbsp;
                        <button class="btn btn-outline-danger" type="button"
                            onclick="window.location.href='{{ route('register') }}'">Register</button>
                    </form>
                @endif
            </div>
    </nav>
</header>
<!-- ======= Navbar End ======= -->


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModallabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Choose Login Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-secondary col-10 mx-2 my-2" data-bs-dismiss="modal"
                        onclick="window.location.href='{{ url('/userlogin') }}'">
                        Student
                    </button>
                    <button type="button" class="btn btn-outline-secondary col-10 mx-2 my-2" data-bs-dismiss="modal"
                        onclick="window.location.href='{{ url('/facultylogin') }}'">
                        Faculty/Staff/Employee
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"
    integrity="sha512-7VTiy9AhpazBeKQAlhaLRUk+kAMAb8oczljuyJHPsVPWox/QIXDFOnT9DUk1UC8EbnHKRdQowT7sOBe7LAjajQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

