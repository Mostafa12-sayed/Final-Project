<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/larkon/admin/pages-404.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Apr 2025 13:11:18 GMT -->
<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Page Not Found - 404 | Larkon - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('dashboard/assets/images/favicon.ico')}}">

    <!-- Vendor css (Require in all Page) -->
    <link href="{{asset('dashboard/assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{asset('dashboard/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{asset('dashboard/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{asset('dashboard/assets/js/config.js')}}"></script>
    <style>
        body{
            background-color: #fdfdfd;
        }
    </style>
</head>
<body class="vh-100">
<div class="d-flex flex-column h-100 p-3">
    <div class="d-flex flex-column flex-grow-1">
        <div class="row h-100">
            <div class="col-xxl-12">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-lg-10">
                        <div class="mx-auto text-center">
                            <img src="{{asset('dashboard/assets/images/403-error.png')}}" alt="" class="img-fluid my-3">
                        </div>
{{--                        <h2 class="fw-bold text-center lh-base">Ooops! Not Authorized To Access This Page</h2>--}}
{{--                        <p class="text-muted text-center mt-1 mb-4">Sorry, we couldn't find the page you were looking for. We suggest that you return to main sections</p>--}}
                        <div class="text-center">
                            <a href="{{route('home')}}" class="btn btn-primary">Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor Javascript (Require in all Page) -->
<script src="{{asset('dashboard/assets/js/vendor.js')}}"></script>

<!-- App Javascript (Require in all Page) -->
<script src="{{asset('dashboard/assets/js/app.js')}}"></script>

</body>


</html>
