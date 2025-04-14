 

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
                                <li><a href=""><i class="far fa-envelope"></i><span class="" >{{ \App\Helpers\Site_Info::site_info()->email }}</span></a></li>
                                <li><i class="far fa-clock"></i>{{ \App\Helpers\Site_Info::site_info()->opening_time }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="{{route('about.index')}}">About Us</a></li>
                                <li><a href="help.html">Delivery Info</a></li>
                                <li><a href="{{route('contact.index')}}">Contact Us</a></li>
                                <li><a href="blog.html">Update News</a></li>
                                <li><a href="testimonial.html">Our Testimonials</a></li>
                                <li><a href="terms.html">Terms Of Service</a></li>
                                <li><a href="privacy.html">Privacy policy</a></li>
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
                    <!-- <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Support Center</h4>
                            <ul class="footer-list">
                                <li><a href="faq.html">FAQ's</a></li>
                                <li><a href="help.html">How To Buy</a></li>
                                <li><a href="help.html">Support Center</a></li>
                                <li><a href="track-order.html">Track Your Order</a></li>
                                <li><a href="return.html">Returns Policy</a></li>
                                <li><a href="affiliate.html">Our Affiliates</a></li>
                                <li><a href="contact.html">Sitemap</a></li>
                            </ul>
                        </div>
                    </div> -->
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
                                <a href="{{ \App\Helpers\Site_Info::site_info()->twitter }}"><i class="fab fa-x-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="{{ \App\Helpers\Site_Info::site_info()->phone1 }}"><i class="fab fa-youtube"></i></a>
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


    <!-- modal quick shop-->
    <div class="modal quickview fade" id="quickview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="far fa-xmark"></i></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-img">
                                <img src="assets/img/product/04.png" alt="#">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h4 class="quickview-title">Surgical Face Mask</h4>
                                <div class="quickview-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <span class="rating-count"> (4 Customer Reviews)</span>
                                </div>
                                <div class="quickview-price">
                                    <h5><del>$860</del><span>$740</span></h5>
                                </div>
                                <ul class="quickview-list">
                                    <li>Brand:<span>Medica</span></li>
                                    <li>Category:<span>Healthcare</span></li>
                                    <li>Stock:<span class="stock">Available</span></li>
                                    <li>Code:<span>789FGDF</span></li>
                                </ul>
                                <div class="quickview-cart">
                                    <a href="#" class="theme-btn">Add to cart</a>
                                </div>
                                <div class="quickview-social">
                                    <span>Share:</span>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal quick shop end -->


    <!-- modal popup banner  -->
	<!-- <div class="modal popup-banner fade" id="popup-banner" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="far fa-xmark"></i></button>
                <div class="modal-body">
                    <div class="popup-banner-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="popup-banner-img">
                                    <img src="assets/img/banner/popup-banner.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                                <div class="popup-banner-info">
                                    <h6>7 Days Super Sale !</h6>
                                    <h2>Hurry Up! Get Up To <span>50%</span> Discount</h2>
                                    <p>There are many variations the majority have suffered alteration in some form injected words look even slightly believable.</p>
                                    <a href="#" class="theme-btn">Start Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- modal popup banner end -->
