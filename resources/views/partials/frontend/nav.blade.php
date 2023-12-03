@if ($disableHero > 0)
    <nav class="navbar navbar-fixed navbar-expand-lg navbar-light py-3 bg-white"
        style="width: 100%; z-index: 999; transition: all 500ms">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center font-weight-bold" href="#" style="flex: 1">
                @if ($config)
                <img src="{{ asset('upload/images/' . $config->logo) }}" alt="" width="50">
                @endif
                <span class=" text-uppercase text-secondary">Per<span class="text-primary">medik</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav justify-content-center flex-grow-1">
                    <li class="nav-item px-2 {{ request()->routeIs('landing') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('landing') }}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{ route('fe.about.index') }}">About Us</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.products.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.products.index') }}">Product</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.contact.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.contact.index') }}">Contact</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.articles.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.articles.index') }}">News</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-lg-5" style="flex: 1">
                    @auth
                        <li class="nav-item px-2 d-flex align-items-center">
                            <div class="dropdown" id="search-dropdown">
                                <div class="d-flex">
                                    <input id='search-btn' type='checkbox' />
                                    <label for='search-btn'>Show search bar</label>
                                    <input id='search-bar' type='text' placeholder='Search...' autocomplete="off" />
                                </div>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-center" href="#">
                                        <div class="spinner-grow" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="cart" href="{{ route('fe.carts.index') }}">
                                <span class="count">{{ getCartCount() }}</span>
                                <!--   <span class="count">1</span> -->
                                <i class="material-icons fa-solid fa-cart-shopping"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('upload/images/' . auth()->user()->profile) }}" width="30"
                                    height="30" alt="profile-user"
                                    onerror="this.onerror=null;this.src='{{ auth()->user()->profile }}';"
                                    class="rounded-circle">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('fe.profile.index') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('fe.orders.index') }}">Pesanan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="logout()">Logout</a>
                            </div>
                        </li>
                        @else
                            <li class="nav-item ml-lg-5">
                                <a class="btn btn-primary rounded-pill px-3" href="{{ route('login') }}">Sign In</a>
                            </li>
                        @endauth
                    </ul>
                {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
            </div>
        </div>
    </nav>
@else
    <nav class="d-none d-lg-block navbar navbar-hero navbar-expand-lg navbar-light bg-white py-3"
        style="position: fixed; width: 100%; z-index: 999">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center font-weight-bold" href="#" style="flex: 1">
                <img src="{{ asset('upload/images/' . $config->logo) }}" alt="" width="50">
                <span class=" text-uppercase text-secondary">Per<span class="text-primary">medik</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav justify-content-center flex-grow-1">
                    <li class="nav-item px-2 {{ request()->routeIs('landing') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('landing') }}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{ route('fe.about.index') }}">About Us</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.products.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.products.index') }}">Product</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.contact.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.contact.index') }}">Contact</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.articles.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.articles.index') }}">News</a>
                    </li>

                  
                </ul>
                <ul class="navbar-nav ml-lg-5" style="flex: 1">
                    @auth
                        <li class="nav-item px-2 d-flex align-items-center">
                            <div class="dropdown" id="search-dropdown">
                                <div class="d-flex">
                                    <input id='search-btn' type='checkbox' />
                                    <label for='search-btn'>Show search bar</label>
                                    <input id='search-bar' type='text' placeholder='Search...' autocomplete="off" />
                                </div>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-center" href="#">
                                        <div class="spinner-grow" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="cart" href="{{ route('fe.carts.index') }}">
                                <span class="count">{{ getCartCount() }}</span>
                                <!--   <span class="count">1</span> -->
                                <i class="material-icons fa-solid fa-cart-shopping"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('upload/images/' . auth()->user()->profile) }}" width="30"
                                    height="30" alt="profile-user"
                                    onerror="this.onerror=null;this.src='{{ auth()->user()->profile }}';"
                                    class="rounded-circle">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('fe.profile.index') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('fe.orders.index') }}">Pesanan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="logout()">Logout</a>
                            </div>
                        </li>
                        @else
                            <li class="nav-item ml-lg-5">
                                <a class="btn btn-primary rounded-pill px-3" href="{{ route('login') }}">Sign In</a>
                            </li>
                        @endauth
                    </ul>
                {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
            </div>
        </div>
    </nav>
    <nav class="d-block d-lg-none navbar navbar-hero navbar-expand-lg navbar-light bg-nav-with-hero py-3"
        style="position: fixed; width: 100%; z-index: 999">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('upload/images/' . $config->logo) }}" alt="" width="50">
                <span class="font-weight-bold text-uppercase text-secondary">Per<span
                        class="text-primary">medik</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse font-weight-bold" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item px-2 {{ request()->routeIs('landing') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('landing') }}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{ route('fe.about.index') }}">About Us</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.products.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.products.index') }}">Product</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.contact.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.contact.index') }}">Contact</a>
                    </li>
                    <li class="nav-item px-2 {{ request()->routeIs('fe.articles.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('fe.articles.index') }}">News</a>
                    </li>

                    @auth
                    @else
                        <li class="nav-item ml-lg-5">
                            <a class=" btn btn-primary rounded-pill px-3 text-white" href="{{ route('login') }}">Sign
                                In</a>
                        </li>

                    @endauth
                    {{-- <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li> --}}
                </ul>
                @auth

                    <ul class="navbar-nav ml-lg-5">
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="cart" href="{{ route('fe.carts.index') }}">
                                <span class="count">{{ getCartCount() }}</span>
                                <!--   <span class="count">1</span> -->
                                <i class="material-icons fa-solid fa-cart-shopping"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('upload/images/' . auth()->user()->profile) }}" width="30"
                                    height="30" alt="profile-user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('fe.profile.index') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('fe.orders.index') }}">Pesanan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="logout()">Logout</a>
                            </div>
                        </li>
                    </ul>
                @endauth
                {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
            </div>
        </div>
    </nav>
@endif
