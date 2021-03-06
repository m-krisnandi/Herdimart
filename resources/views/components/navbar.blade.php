<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('admin/img/logo/Group-40.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mentor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Business</a>
                </li> --}}
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <form action="">
                    <input class="txt-search" type="text" name="search" placeholder="Cari barang">
                    <button class="btn-search" style="border: none !important;" type="submit"><img class="button-search" src="{{ asset('images/Search-button.png') }}"></button>
                    {{-- <a href="#search" class="btn-search">

                    </a> --}}
                </form>

                {{-- <a href=""><img src="{{ asset('images/Troli.svg') }}" alt=""></a> --}}
                <a href="" class="nav-link">
                    {{-- <img src="{{ asset('images/Troli.png') }}" alt=""> --}}
                    {{-- <span class="fa fa-shopping-cart">
                        ({{session()->has('cart')?session()->get('cart')->totalQty:'0'}})
                    </span> --}}
                </a>
            </ul>

            @auth
            <div class="d-flex user-logged nav-item dropdown no arrow">
                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- Halo, {{ Auth::user()->name }} --}}
                    @if (Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" style="height: 50px" class="user-photo rounded" alt="">
                    @else
                        <img src="https://ui-avatars.com/api/?name=admin" class="user-photo rounded" alt="">
                    @endif
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="right: 0; left:auto">
                        @if(Auth::user()->is_admin)
                            <li>
                                <a href="{{ route('dashboard.admin') }}" class="dropdown-item">My Dashboard</a>
                            </li>
                        @else

                            {{-- <li>
                                <a href="{{ route('order' ) }}" class="dropdown-item">My Dashboard</a>
                            </li> --}}

                        @endif
                        <li>
                            <a href="#" class="dropdown-item"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit()">Sign Out</a>

                        <form action="{{ route('logout') }}" id="logout-form" method="post" style="display: none">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                        </li>
                    </ul>
                </a>
            </div>
                <a href="{{route('cart-show')}}" class="nav-link">
                    <img src="{{ asset('images/Troli.png') }}" alt="">
                    {{-- <span class="fa fa-shopping-cart">
                        ({{session()->has('cart')?session()->get('cart')->totalQty:'0'}})
                    </span> --}}
                </a>

            <a href="{{ route('order' ) }}" class="nav-link">
                <img src="{{ asset('images/Pesanan.png') }}" alt="">
            </a>
                @else
                {{-- <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-master btn-secondary me-3">
                        Sign In
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-master btn-primary">
                        Sign Up
                    </a>
                </div> --}}

                <div class="d-flex user-logged nav-item dropdown no arrow">
                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- Halo, {{ Auth::user()->name }} --}}
                            <img src="{{ asset('images/Profile.png') }}" alt="">
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="right: 0; left:auto">
                                <li>
                                    <a href="{{ route('login') }}" class="dropdown-item">Sign In</a>
                                </li>
                            </li>
                        </ul>
                    </a>
                </div>
                    <a href="{{route('cart-show')}}" class="nav-link">
                        <img src="{{ asset('images/Troli.png') }}" alt="">
                        {{-- <span class="fa fa-shopping-cart">
                            ({{session()->has('cart')?session()->get('cart')->totalQty:'0'}})
                        </span> --}}
                    </a>

                <a href="{{ route('order' ) }}" class="nav-link">
                    <img src="{{ asset('images/Pesanan.png') }}" alt="">
                </a>
            @endauth

        </div>
    </div>
</nav>
