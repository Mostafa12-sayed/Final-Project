

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
                                                <img src="{{ Auth::user()->image_url }}" alt="" id="profileImage2" style="border-radius: 50%;  width: 100%;">
                                                @elseif (Auth::user()->profile_image)
                                                <img src="{{ Auth::user()->profile_image }}" alt="" id="profileImage1" style="border-radius: 50%;  width: 100%;">
                                                @else
                                                <img src="{{ asset('assets/img/account').'/04.jpg'}}" alt="" id="profileImage3" style="border-radius: 50%;  width: 100%;">
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
                                        <div class="list-item-icon">
                                            <i class="far fa-shopping-bag"></i><span>{{ count(session('cart', [])) }}</span>
                                        </div>
                                        <div class="list-item-info">
                                            <!-- <h6>${{ number_format($cartTotal ?? 0, 2) }}</h6> -->
                                            <h5>My Cart</h5>
                                        </div>
                                    </a>
                                    <!-- <div class="dropdown-cart-menu">
                                        <div class="dropdown-cart-header">
                                            <span>03 Items</span>
                                            <a href="#">View Cart</a>
                                        </div>
                                        <ul class="dropdown-cart-list">
                                            <li>
                                                <div class="dropdown-cart-item">
                                                    <div class="cart-img">
                                                        <a href="#"><img src="assets/img/product/01.png" alt="#"></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h4><a href="#">Surgical Face Mask</a></h4>
                                                        <p class="cart-qty">1x - <span
                                                                class="cart-amount">$200.00</span></p>
                                                    </div>
                                                    <a href="#" class="cart-remove" title="Remove this item"><i
                                                            class="far fa-times-circle"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-cart-item">
                                                    <div class="cart-img">
                                                        <a href="#"><img src="assets/img/product/02.png" alt="#"></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h4><a href="#">Surgical Face Mask</a></h4>
                                                        <p class="cart-qty">1x - <span
                                                                class="cart-amount">$120.00</span></p>
                                                    </div>
                                                    <a href="#" class="cart-remove" title="Remove this item"><i
                                                            class="far fa-times-circle"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-cart-item">
                                                    <div class="cart-img">
                                                        <a href="#"><img src="assets/img/product/03.png" alt="#"></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h4><a href="#">Surgical Face Mask</a></h4>
                                                        <p class="cart-qty">1x - <span
                                                                class="cart-amount">$330.00</span></p>
                                                    </div>
                                                    <a href="#" class="cart-remove" title="Remove this item"><i
                                                            class="far fa-times-circle"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="dropdown-cart-bottom">
                                            <div class="dropdown-cart-total">
                                                <span>Total</span>
                                                <span class="total-amount">$650.00</span>
                                            </div>
                                            <a href="#" class="theme-btn">Checkout</a>
                                        </div>
                                    </div> -->
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
                    <a class="navbar-brand" href="index-2.html">
                        <img src="assets/img/logo/logo.png" class="logo-scrolled" alt="logo">
                    </a>
                    <div class="category-all">
                        <button class="category-btn" type="button">
                            <i class="fas fa-list-ul"></i><span>All Categories</span>
                        </button>
                        <ul class="main-category">
                            <li>
                                <a href="#">
                                    <img src="assets/img/icon/medicine.svg" alt="">
                                    <span>Medicine</span><i class="far fa-angle-right"></i>
                                </a>
                                <div class="sub-category-mega">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="category-single">
                                                <h6 class="category-title-text">Medicine</h6>
                                                <div class="category-link">
                                                    <a href="#">Allergies & Sinus</a>
                                                    <a href="#">E.N.T Preparations</a>
                                                    <a href="#">Eye Preparations</a>
                                                    <a href="#">Vitamin & Nutritional</a>
                                                    <a href="#">Fever & Pain Relief</a>
                                                    <a href="#">Dermatological</a>
                                                    <a href="#">Bone Formation</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="category-single">
                                                <h6 class="category-title-text">Medicine</h6>
                                                <div class="category-link">
                                                    <a href="#">Allergies & Sinus</a>
                                                    <a href="#">E.N.T Preparations</a>
                                                    <a href="#">Eye Preparations</a>
                                                    <a href="#">Vitamin & Nutritional</a>
                                                    <a href="#">Fever & Pain Relief</a>
                                                    <a href="#">Dermatological</a>
                                                    <a href="#">Bone Formation</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="category-single">
                                                <h6 class="category-title-text">Medicine</h6>
                                                <div class="category-link">
                                                    <a href="#">Allergies & Sinus</a>
                                                    <a href="#">E.N.T Preparations</a>
                                                    <a href="#">Eye Preparations</a>
                                                    <a href="#">Vitamin & Nutritional</a>
                                                    <a href="#">Fever & Pain Relief</a>
                                                    <a href="#">Dermatological</a>
                                                    <a href="#">Bone Formation</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="category-img">
                                                <a href="#"><img src="assets/img/banner/category-banner.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#"><img src="assets/img/icon/health-care.svg" alt=""><span>Healthcare</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/beauty-care.svg" alt=""><span>Beauty Care</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/sexual.svg" alt=""><span>Sexual Wellness</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/fitness.svg" alt=""><span>Fitness</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/lab-test.svg" alt=""><span>Lab Test</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/baby-mom-care.svg" alt=""><span>Baby & Mom Care</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/supplements.svg" alt=""><span>Vitamins & Supplement</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/food-nutrition.svg" alt=""><span>Food & Nutrition</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/medical-equipements.svg" alt=""><span>Medical Equipments</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/medical-supplies.svg" alt=""><span>Medical Supplies</span></a></li>
                            <li><a href="#"><img src="assets/img/icon/pet-care.svg" alt=""><span>Pet Care</span></a></li>
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
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1">
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('about.index') }}">About</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Pages</a>
                                    <ul class="dropdown-menu fade-down">
                                        <li><a class="dropdown-item" href="about.html">About Us</a></li>
                                        <li><a class="dropdown-item" href="brand.html">Brands</a></li>
                                        <li><a class="dropdown-item" href="{{ route('category.index') }}">Category</a></li>
                                        <!-- <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Category</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('category.index') }}">Category One</a></li>
                                                <li><a class="dropdown-item" href="{{ route('category.index') }}">Category Two</a>
                                                </li>
                                            </ul>
                                        </li> -->
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Authentication</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="login.html">Login</a></li>
                                                <li><a class="dropdown-item" href="register.html">Register</a></li>
                                                <li><a class="dropdown-item" href="forgot-password.html">Forgot
                                                        Password</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Extra Pages</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="coming-soon.html">Coming Soon</a>
                                                </li>
                                                <li><a class="dropdown-item" href="return.html">Return Policy</a></li>
                                                <li><a class="dropdown-item" href="terms.html">Terms Of Service</a></li>
                                                <li><a class="dropdown-item" href="privacy.html">Privacy Policy</a></li>
                                                <li><a class="dropdown-item" href="mail-success.html">Mail Success</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="team.html">Our Team</a></li>
                                        <li><a class="dropdown-item" href="affiliate.html">Affiliate</a></li>
                                        <li><a class="dropdown-item" href="gallery.html">Our Gallery</a></li>
                                        <li><a class="dropdown-item" href="{{ route('contact.index') }}">Contact Us</a></li>
                                        <li><a class="dropdown-item" href="help.html">Help</a></li>
                                        <li><a class="dropdown-item" href="invoice.html">Invoices</a></li>
                                        <li><a class="dropdown-item" href="faq.html">Faq</a></li>
                                        <li><a class="dropdown-item" href="testimonial.html">Testimonials</a></li>
                                        <li><a class="dropdown-item" href="404.html">404 Error</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Account</a>
                                    <ul class="dropdown-menu fade-down">
                                        <li><a class="dropdown-item" href="user-dashboard.html">Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{route('profile.index')}}">My Profile</a></li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Orders</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('order.list') }}">Orders List</a></li>
                                                <li><a class="dropdown-item">Order Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="wishlist.html">My Wishlist</a></li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Address</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="address-list.html">Address List</a>
                                                </li>
                                                <li><a class="dropdown-item" href="add-address.html">Add Address</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Support Tickets</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="support-ticket.html">Support
                                                        Tickets</a></li>
                                                <li><a class="dropdown-item" href="ticket-detail.html">Ticket
                                                        Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('order.track') }}">Track My Order</a></li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Payment Methods</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="payment-method.html">Payment
                                                        Methods</a></li>
                                                <li><a class="dropdown-item" href="add-payment.html">Add Payment</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="user-notification.html">Notification</a></li>
                                        <li><a class="dropdown-item" href="user-message.html">Messages</a></li>
                                        <li><a class="dropdown-item" href="user-setting.html">Settings</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item mega-menu dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Menu</a>
                                    <div class="dropdown-menu fade-down">
                                        <div class="mega-content">
                                            <div class="container-fluid px-lg-0">
                                                <div class="row">
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Medicine</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Allergies & Sinus</a></li>
                                                            <li><a class="dropdown-item" href="shop-grid.html">E.N.T Preparations</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Eye Preparations</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Vitamin & Nutritional</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Fever & Pain Relief</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Dermatological</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Equipment</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Biopsy Tools</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Monitoring</a></li>
                                                            <li><a class="dropdown-item" href="shop-grid.html">Infusion Stands</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="shop-grid.html">Lighting</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Machines</a></li>
                                                            <li><a class="dropdown-item" href="shop-grid.html">Thermometer</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Wound Care</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Surgical Sutures</a></li>
                                                            <li><a class="dropdown-item" href="shop-grid.html">Bandages</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Patches and Tapes</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Stomatology</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Wound Healing</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Uniforms</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Higiene</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Face Masks</a></li>
                                                            <li><a class="dropdown-item" href="shop-grid.html">Sterilization</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Surgical Foils</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Disposable Products</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Protective Covers</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="shop-grid.html">Diagnostic Tests</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <div class="mega-menu-img">
                                                            <a href="#"><img
                                                                    src="assets/img/banner/mega-menu-banner.jpg"
                                                                    alt=""></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop</a>
                                    <ul class="dropdown-menu fade-down">
                                        <!-- <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Shop Grid</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{route('products')}}">Shop Grid One</a>
                                                </li>
                                                <li><a class="dropdown-item" href="shop-grid-2.html">Shop Grid Two</a>
                                                </li>
                                            </ul>
                                        </li> -->
                                        <li><a class="dropdown-item" href="{{ route('products') }}">Products</a></li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Shop List</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="shop-list.html">Shop List One</a>
                                                </li>
                                                <li><a class="dropdown-item" href="shop-list-2.html">Shop List Two</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="shop-search.html">Shop Search</a></li>
                                        <li><a class="dropdown-item" href="shop-cart.html">Shop Cart</a></li>
                                        <li><a class="dropdown-item" href="{{ route('order.checkout') }}">Checkout</a></li>
                                        <li><a class="dropdown-item" href="{{ route('order.checkout') }}">Checkout
                                                Complete</a></li>
                                        <li><a class="dropdown-item" href="shop-single.html">Shop Single</a></li>
                                        <li><a class="dropdown-item" href="shop-compare.html">Shop Compare</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog</a>
                                    <ul class="dropdown-menu fade-down">
                                        <li><a class="dropdown-item" href="blog-grid.html">Blog Grid</a></li>
                                        <li><a class="dropdown-item" href="blog-grid-sidebar.html">Blog Grid Sidebar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="blog-single.html">Blog Single</a></li>
                                        <li><a class="dropdown-item" href="blog-single-sidebar.html">Blog Single
                                                Sidebar</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Contact</a></li>
                            </ul>
                            <!-- nav-right -->
                            <div class="nav-right">
                                <a class="nav-right-link" href="#"><i class="fal fa-star"></i> Recently Viewed</a>
                                <a class="nav-right-link" href="{{ route('order.track') }}"><i class="fal fa-truck-fast"></i> Track My Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- navbar end -->

    </header>
    <!-- header area end -->

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




