@if ($disableHero > 0)
<nav class="navbar navbar-expand-lg navbar-light py-3 bg-white">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('frontend/img/logo.png') }}" alt="" width="50">
            <span class="font-weight-bold text-uppercase text-secondary">Per<span class="text-primary">medik</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('landing') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('landing') }}">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item {{ request()->routeIs('fe.products.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('fe.products.index') }}">Product</a>
                </li>
                <li class="nav-item {{ request()->routeIs('fe.products.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('fe.products.index') }}">Contact</a>
                </li>
                
                @auth
                
                <li class="nav-item ml-lg-5">
                    <a class="cart">
                        <span class="count">1</span>
                        <!--   <span class="count">1</span> -->
                        <i class="material-icons fa-solid fa-cart-shopping"></i>
                    </a>
                    {{-- <a href="{{ route('fe.carts.index') }}" class="btn btn-primary rounded-pill px-3 text-white"><i
                            class="fa-solid fa-cart-shopping"></i></a> --}}
                </li>
                @else
                    <li class="nav-item ml-lg-5">
                        <a class=" btn btn-primary rounded-pill px-3 text-white">Register</a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('login') }}" class=" btn btn-outline-primary rounded-pill px-3 ml-lg-2">Sign In</a>
                    </li>
                @endauth
                {{-- <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li> --}}
            </ul>
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>
@else

<nav class="navbar navbar-hero navbar-expand-lg navbar-light {{ $disableHero > 1 ? 'bg-light' : 'bg-transparent' }} py-3"
    style="position: fixed; width: 100%; z-index: 999">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('frontend/img/logo.png') }}" alt="" width="50">
            <span class="font-weight-bold text-uppercase text-secondary">Per<span class="text-primary">medik</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('landing') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('landing') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item {{ request()->routeIs('fe.products.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('fe.products.index') }}">Product</a>
                </li>
                <li class="nav-item {{ request()->routeIs('fe.products.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('fe.products.index') }}">Contact</a>
                </li>
                
                @auth
                    <li class="nav-item ml-lg-5">
                        <a class="cart">
                            <span class="count">1</span>
                            <!--   <span class="count">1</span> -->
                            <i class="material-icons fa-solid fa-cart-shopping"></i>
                        </a>
                        {{-- <a href="{{ route('fe.carts.index') }}" class="btn btn-primary rounded-pill px-3 text-white"><i
                                class="fa-solid fa-cart-shopping"></i></a> --}}
                    </li>
                @else
                    <li class="nav-item ml-lg-5">
                        <a class=" btn btn-primary rounded-pill px-3 text-white">Registerr</a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('login') }}" class=" btn btn-outline-primary rounded-pill px-3 ml-lg-2">Sign In</a>
                    </li>
                @endauth
                {{-- <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li> --}}
            </ul>
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>
@endif