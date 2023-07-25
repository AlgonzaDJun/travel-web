<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('frontend/images/logo.png', []) }}" alt="Logo Nomads" />
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbwar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbwar">
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item mx-md-2">
                    <a href="/" class="nav-link active">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#popular" class="nav-link">Travel</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbar-drop" data-toggle="dropdown">
                        Service
                    </a>
                    <div class="dropdown-menu">
                        <a href="#popular" class="dropdown-item">Travel</a>
                    </div>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#testimonial-heading" class="nav-link">Testimonial</a>
                </li>
            </ul>

            @guest
                <!-- mobile button -->
                <form action="" class="form-inline d-sm-block d-md-none">
                    <button class="btn btn-login px-4" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}';">Masuk</button>
                </form>

                <!-- desktop button -->
                <form action="/login" class="form-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                        Masuk
                    </button>
                </form>

            @endguest

            @auth
                <!-- mobile button -->
                <form action="{{ url('logout', []) }}" class="form-inline d-sm-block d-md-none" method="POST">
                    @csrf
                    <button class="btn btn-login px-4" type="submit">keluar</button>
                </form>

                <!-- desktop button -->
                <form action="{{ url('logout', []) }}" class="form-inline my-2 my-lg-0 d-none d-md-block" method="POST">
                    @csrf
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                        keluar
                    </button>
                </form>
            @endauth
        </div>
    </nav>
</div>
