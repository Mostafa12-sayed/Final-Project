
<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from techzaa.in/larkon/admin/auth-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Apr 2025 13:11:18 GMT -->
<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Dashboard | @yield('title')</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template" />
     <meta name="author" content="Techzaa" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="csrf-token" content="{{ csrf_token() }}">

     @stack('styles')
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

     <link  href="{{ asset('vendor/flasher/flasher.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="h-100">


     
     <div class="wrapper">
          @if (session()->has('flasher_messages'))
                    @foreach (session('flasher_messages') as $message)
                    <div class="alert alert-{{ $message['type'] }}">
                         {{ $message['message'] }}
                    </div>
                    @endforeach
          @endif
          <!-- ========== Topbar Start ========== -->
     
          @include('dashboard::layouts.includes.header')
          @include('dashboard::layouts.includes.sidebar')

            @yield('content')
    </div>
     <!-- Vendor Javascript (Require in all Page) -->
     <script src="{{asset('dashboard/assets/js/vendor.js')}}"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{asset('dashboard/assets/js/app.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
     @include('dashboard::layouts.script')
     @stack('scripts') {{-- مهم لعرض السكربت --}}
    @yield('script')

</body>

</html>