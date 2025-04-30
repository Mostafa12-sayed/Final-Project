

    <!-- preloader -->
   <div class="preloader">
        <div class="loader-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- header area -->
    <header class="header">



        <!-- header middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-5 col-lg-3 col-xl-3">
                        <div class="header-middle-logo">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img src="assets/img/logo/logo.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-6 col-xl-5">
                        <div class="header-middle-search">
                            <form action="#">
                                <div class="search-content">
                                    @livewire('search-products')
                                    <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-7 col-lg-3 col-xl-4">
                        <div class="header-middle-right">
                            <ul class="header-middle-list">
                                <li>
                                    @guest
                                    <a href="{{route('login')}}" class="list-item" style="text-decoration: none;">
                                        <div class="list-item-icon">
                                            <i class="far fa-user-circle"></i>
                                        </div>
                                        <div class="list-item-info">
                                                @if (Route::has('login'))
                                                <h6>Sign In</h6>
                                                <h5>Account</h5>
                                                @endif
                                            @else
                                                <a href="{{route('profile.index')}}" class="list-item" style="text-decoration: none;">
                                                <div class="list-item-icon">
                                                @if (Auth::user()->image_url)
                                                <img src="{{ Auth::user()->image_url }}" alt="" id="profileImage2" style="border-radius: 50%; height: 50px;  width: 100%;">
                                                @elseif (Auth::user()->profile_image)
                                                <img src="{{ Auth::user()->profile_image }}" alt="" id="profileImage1" style="border-radius: 50%; height: 50px;  width: 100%;">
                                                @else
                                                <img src="{{ asset('assets/img/account').'/04.jpg'}}" alt="" id="profileImage3" style="border-radius: 50%;height: 50px;  width: 100%;">
                                                @endif
                                                </div>
                                                <div class="list-item-info">
                                                <h6 class="" role="button">{{ ucfirst(Auth::user()->name) }}</h6>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item" style="text-decoration: underline;">Logout</button>
                                                </form>
                                            @endguest
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ auth()->check() ? route('wishlist.index') : route('login') }}" class="list-item">
                                        <div class="list-item-icon">
                                            <i class="far fa-heart"></i>
                                            @auth
                                                <span>{{ Auth::user()->wishlist()->count() }}</span>
                                            @else
                                                <span>0</span>
                                            @endauth
                                        </div>
                                        <div class="list-item-info">
                                            <h5>My Wishlist</h5>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-cart">
                                    <a href="{{ route('cart.index') }}" class="shop-cart list-item">
                                        <div class="list-item-icon cart_count" data-count="{{ count(session('cart', [])) }}">
                                            <i class="far fa-shopping-bag"></i><span>{{ count(session('cart', [])) }}</span>
                                        </div>
                                        <div class="list-item-info">
                                            <!-- <h6>${{ number_format($cartTotal ?? 0, 2) }}</h6> -->
                                            <h5>My Cart</h5>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header middle end -->

        <!-- navbar -->
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="assets/img/logo/logo.png" class="logo-scrolled" alt="logo">
                    </a>
                    <div class="category-all">
                        <button class="category-btn" type="button">
                            <i class="fas fa-list-ul"></i><span>All Categories</span>
                        </button>
                        <ul class="main-category">
                            @foreach ($categories as $category)
                            <li><a href="{{ route('products') }}?category={{ $category->slug }}"><img src="{{ $category->image }}" alt=""><span>{{ $category->name }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mobile-menu-right">
                        <div class="mobile-menu-btn">
                            <a href="#" class="nav-right-link search-box-outer"><i class="far fa-search"></i></a>
                            <a href="wishlist.html" class="nav-right-link"><i
                                    class="far fa-heart"></i><span>2</span></a>
                            <a href="shop-cart.html" class="nav-right-link"><i
                                    class="far fa-shopping-bag"></i><span>5</span></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <a href="index-2.html" class="offcanvas-brand" id="offcanvasNavbarLabel">
                                <img src="assets/img/logo/logo.png" alt="">
                            </a>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" style="gap: 0px;">
                            <ul class="navbar-nav justify-content-end flex-grow-1">
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('about.index') }}">About</a></li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{ route('category.index') }}">Categories</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{ route('products') }}">Products</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{ route('compare.index') }}" >Compare</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Contact</a></li>
                            </ul>
                            <!-- nav-right -->
                            <div class="nav-right">
                                <div class="search-content">
                                    @livewire('search-products')
                                </div>
                                <a class="nav-right-link" href="{{ route('order.track') }}"><i class="fal fa-truck-fast"></i>Track My Order</a>
                                <a href="{{ route('cart.index') }}" class="shop-cart list-item">
                                        <div class="list-item-icon cart_count " data-count="{{ count(session('cart', [])) }}">
                                            <i class="far fa-shopping-bag" style="color: black;" ></i><span style="padding: 2px; background-color: #03a297; border-radius: 50%;">{{ count(session('cart', [])) }}</span>
                                        </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- navbar end -->

    </header>
    <!-- header area end -->

        <!-- mobile popup search -->
        <div class="search-popup">
        <button class="close-search"><span class="far fa-times"></span></button>
        <form action="#">
            <div class="search-content">
                @livewire('search-products')
            </div>
        </form>
    </div>
    <!-- mobile popup search end -->

    <script>
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Get the dropdown toggle button and dropdown menu
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        // Check if both elements exist
        if (dropdownToggle && dropdownMenu) {
            // Add a click event listener to the dropdown toggle
            dropdownToggle.addEventListener('click', function (event) {
                // Prevent the default behavior
                event.preventDefault();

                // Toggle the 'show' class to open/close the dropdown menu
                dropdownMenu.classList.toggle('show');

                // Optionally, toggle the aria-expanded attribute for accessibility
                const isExpanded = dropdownToggle.getAttribute('aria-expanded') === 'true';
                dropdownToggle.setAttribute('aria-expanded', !isExpanded);
            });

            // Optionally, close the dropdown if the user clicks outside of it
            document.addEventListener('click', function (event) {
                // Close the dropdown if the click was outside of the dropdown
                if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });
</script>




