@extends('website::layouts.master')
@section('content')

    <main class="main">
        

        <!-- error area -->
        <div class="error-area py-100">
            <div class="container">
                <div class="col-md-6 mx-auto">
                    <div class="error-wrapper">
                        <div class="error-img">
                            <img src="assets/img/error/01.png" alt="">
                        </div>
                        <h2>Opos... Page Not Found!</h2>
                        <p>The page you looking for not found may be it not exist or removed.</p>
                        <a href="{{ route('home') }}" class="theme-btn">Go Back Home <i class="far fa-home"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- error area end -->

    </main>



    @endsection