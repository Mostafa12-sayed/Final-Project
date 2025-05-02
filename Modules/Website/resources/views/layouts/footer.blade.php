 

 <!-- footer area -->
   <footer class="footer-area">
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-40">
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box about-us">
                            <a href="{{route('home')}}" class="footer-logo">
                                <img src="{{ \App\Helpers\Site_Info::site_info()->logo_path }}" alt="">
                            </a>
                            <p class="mb-3">
                            {{ \App\Helpers\Site_Info::site_info()->about }}
                            </p>
                            <ul class="footer-contact">
                                <li><a href="tel:{{ \App\Helpers\Site_Info::site_info()->phone1 }}"><i class="far fa-phone"></i>+2 {{ \App\Helpers\Site_Info::site_info()->phone1 }}</a></li>
                                <li><i class="far fa-map-marker-alt"></i>{{ \App\Helpers\Site_Info::site_info()->address }}</li>
                                <li><a href="mailto:{{ \App\Helpers\Site_Info::site_info()->email }}"><i class="far fa-envelope"></i><span class="" >{{ \App\Helpers\Site_Info::site_info()->email }}</span></a></li>
                                <li><i class="far fa-clock"></i>{{ \App\Helpers\Site_Info::site_info()->opening_time }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="{{route('about.index')}}">About Us</a></li>
                                <li><a class="nav-right-link" href="{{ route('order.track') }}">Track My Order</a>
                                </li>
                                <li><a href="{{route('contact.index')}}">Contact Us</a></li>
                                <li><a href="{{route('products')}}">Products</a></li>
                                <li><a href="{{route('cart.index')}}">shop Cart</a></li>
                                <li><a href="{{route('compare.index')}}">Compare</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Browse Category</h4>
                            <ul class="footer-list">
                                @foreach (\App\Helpers\Site_Info::categories() as $category)
                                <li><a href="{{ route('products') }}?category={{ $category->slug }}">{{$category->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Payment Methods</h4>
                            <div class="footer-payment mt-20">
                                <span>We Accept:</span>
                                <img src="assets/img/payment/visa.svg" alt="">
                                <img src="assets/img/payment/mastercard.svg" alt="">
                                <img src="assets/img/payment/amex.svg" alt="">
                                <img src="assets/img/payment/discover.svg" alt="">
                                <img src="assets/img/payment/paypal.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="copyright-wrap">
                    <div class="row">
                        <div class="col-12 col-lg-6 align-self-center">
                            <p class="copyright-text">
                                &copy; Copyright <span id="date"></span> <a href="{{ route('home') }}"> Medion </a> All Rights Reserved.
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 align-self-center">
                            <div class="footer-social">
                                <span>Follow Us:</span>
                                <a href="{{ \App\Helpers\Site_Info::site_info()->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ \App\Helpers\Site_Info::site_info()->twitter }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
                                <a href="{{ \App\Helpers\Site_Info::site_info()->phone1 }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->


    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>
    <!-- scroll-top end -->






