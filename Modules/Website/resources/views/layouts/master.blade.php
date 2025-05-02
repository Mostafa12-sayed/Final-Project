<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{ url('/') }}"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Website Module - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product-modal.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{-- Vite CSS (uncomment if needed) --}}
    {{-- {{ module_vite('build-website', 'resources/assets/sass/app.scss') }} --}}
</head>
<body>
    @include('website::layouts.header')

    @yield('content')
    <!-- Quick View Modal -->
    <div class="modal fade quickview" id="website-table-modal" tabindex="-1" aria-labelledby="quickViewModalLabel" >

                    <!-- AJAX content will be injected here -->

    </div>
    @include('website::layouts.footer')
        <!-- js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/counter-up.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('assets/js/countdown.min.js') }}"></script>
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@livewireStyles
@livewireScripts

    {{-- Yield custom scripts from child views --}}
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Ajax for quickview -->
    <script>
        $(document).on('click', '.btn-modal', function (e) {
            e.preventDefault();

            var container = $(this).data('container');

            $.ajax({
                url: $(this).data('href'),
                dataType: 'html',
                success: function (result) {
                    $(container)
                        .html(result)
                        .modal('show');
                    const modalEl = $(container).find('.modal').get(0);
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                },
            });
        });

        $('.btn-close').on('click', function (e) {
            e.preventDefault();
            $(this).closest('.modal').modal('hide');
           $('.modal').style.display = 'none';
        });

    </script>
    <!-- Toast for add to cart-->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="add_to_cart_toast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
        <div class="toast-body">
            Added To Your Cart Successfully
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    </div>

        <!-- Toast for wishlist -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="add_to_wish_list_toast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
        <div class="toast-body">
            Added To Your Wishlist
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    </div>

        <!-- jquery cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- add to cart ajax -->
    <script>

        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Handle Add to Cart button click
        $('.add-to-cart').on('click', function (e) {
            e.preventDefault();

            var button = $(this);
            var productId = button.data('product-id');

            // Disable button to prevent multiple clicks
            button.prop('disabled', true);

            $.ajax({
                url: '{{ route("cart.add_ajax", ["product" => ":productId"]) }}'.replace(':productId', productId), // Dynamically replace the placeholder
                method: 'POST',
                data: {
                    quantity: 1 // You can still send quantity in the body if needed
                },
                success: function (response) {

                    // Re-enable button
                    button.prop('disabled', false);

                    // Show success message
                    if (response.success) {
                        // alert('Product added to cart successfully!');
                     }
                    //  else {
                    //     alert('Failed to add product to cart: ' + (response.message || 'Unknown error'));
                    // }
                    var toastEl = document.getElementById('add_to_cart_toast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                    if (response.cart_count !== undefined) {
                        $('.cart_count')
                            .attr('data-count', response.cart_count)
                            .find('span')
                            .text(response.cart_count);
                    } else {
                        // Fallback: increment client-side
                        var cartCountElement = $('.cart_count');
                        var currentCount = parseInt(cartCountElement.data('count')) || 0;
                        cartCountElement
                            .attr('data-count', currentCount + 1)
                            .find('span')
                            .text(currentCount + 1);
                    } },
                error: function (xhr) {
                    // Re-enable button
                    button.prop('disabled', false);

                    // Show error message
                    var errorMsg = 'An error occurred while adding to cart.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                }
            });
        });
    </script>
<script>
    window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
</script>

<!-- script for add to wish list  -->
<script>
    $(document).ready(function () {

        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle Add to Wishlist click
        $('.add-to-wishlist').on('click', function (e) {
            e.preventDefault();

            var button = $(this);
            var productId = button.data('product-id');
            var icon = button.find('i');
            var isInWishlist = icon.hasClass('fas'); // Check if it's already filled (in wishlist)

            // Define base URLs (these should match your Laravel routes)
            var baseAddUrl = '/wishlist/aj/add';
            var baseRemoveUrl = '/wishlist/aj/remove';

            if (!window.isAuthenticated) {
                Toastify({
                    text: "Please log in first to add items to your wishlist.",
                    duration: 3000,
                    gravity: "bottom", // top or bottom
                    position: "right", // left, center or right
                    backgroundColor: "#f44336", // red-ish background
                    close: true
                }).showToast();
                return;
            }

            // Construct the full URL based on whether the item is in the wishlist
            var url = isInWishlist ? baseRemoveUrl + '/' + productId : baseAddUrl + '/' + productId;
            var method = isInWishlist ? 'DELETE' : 'POST';
            // Disable button to prevent multiple clicks
            button.prop('disabled', true);

            $.ajax({
                url: url,
                method: method,
                data: {
                    quantity: 1 // Optional, if needed
                },
                success: function (response) {

                    // Re-enable button
                    button.prop('disabled', false);

                    // Show success or error message
                    if (response.success) {
                        alert('Product added to wishlist successfully!');
                        // Optional: Change icon to indicate it's in wishlist (e.g., filled heart)
                        button.find('i').removeClass('far').addClass('fas');
                    }
                    if(method=='DELETE'){
                        button.find('i').removeClass('fas').addClass('far');
                    }
                    if(method=='POST'){
                        button.find('i').removeClass('far').addClass('fas');
                    }



                    var toastEl = document.getElementById('add_to_wish_list_toast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                },
                error: function (xhr) {
                    button.prop('disabled', false);

                    if(method=='DELETE'){
                        button.find('i').removeClass('fas').addClass('far');
                    }
                    // Show error message
                    var errorMsg = 'An error occurred while adding to wishlist.';
                }
            });
        });


    });



    // ajax for compare
    $(document).ready(function() {
    $('.add-to-compare').on('click', function(e) {
        e.preventDefault();
        var button = $(this);
        var productId = button.data('product-id');

        $.ajax({
            url: '/compare/add/' + productId,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Update compare count in navbar
                    $('.compare-count').text(response.compare_count);

                    Toastify({
                        text: response.message,
                        duration: 3000,
                        className: "bg-success"
                    }).showToast();
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        className: "bg-danger"
                    }).showToast();
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>



    {{-- Vite JS (uncomment if needed) --}}
    {{-- {{ module_vite('build-website', 'resources/assets/js/app.js') }} --}}
</body>
</html>
