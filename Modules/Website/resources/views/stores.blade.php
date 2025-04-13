@extends('website::layouts.master')
@section('content')
    <!-- mobile popup search -->
    <div class="search-popup">
        <button class="close-search"><span class="far fa-times"></span></button>
        <form action="#">
            <div class="form-group">
                <input type="search" name="search-field" class="form-control" placeholder="Search Here..." required>
                <button type="submit"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- mobile popup search end -->

        <!-- brand area -->
        <div class="brand-area2 py-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Stores</span>
                            <h2 class="site-title">Our Popular <span>Stores</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    @foreach ($stores as $store)
                    <div class="col-md-6 col-lg-2">
                        <div class="brand-item">
                            <img src="assets/img/brand/01.png" alt="">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- brand area end -->

    </main>

    @endsection
